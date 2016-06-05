$(function () {

    /****** MENSAGENS DE CARREGAMENTO AJAX *****/
    //Verifica se uma variável está em um determinado array
    function inArray(needle, haystack) {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle)
                return true;
        }
        return false;
    }

    //Mensagem Padronizada exibida antes do envio dos formulários
    function msgBefore(box, data) {
        var $box = $(box);
        var $icon = $(box + " i");
        var $text = $(box + " span");
        $box.css({'padding': "10px"});
        $box.removeClass('uk-alert-check');
        $box.removeClass('uk-alert-danger');
        $box.fadeIn('slow');
        if (data === undefined) {
            $text.html("Analisando dados...");
        } else {
            $text.html(data);
        }
        $icon.addClass("uk-icon-cog");
        $icon.addClass("uk-icon-small");
        $icon.addClass("uk-icon-spin");
    }

    //Mensagem Padronizada exibida depois do envio dos formulários
    function msgSucessTrue(box, data) {
        var $box = $(box);
        var $icon = $(box + " i");
        var $text = $(box + " span");
        //Cor do box
        $box.removeClass("uk-alert-danger");
        $box.removeClass("uk-alert-primary");
        $box.addClass("uk-alert-success");
        //Ícone
        $icon.removeClass("uk-icon-warning");
        $icon.removeClass("uk-icon-cog");
        $icon.removeClass("uk-icon-spin");
        $icon.addClass("uk-icon-check");
        $icon.addClass("uk-icon-small");
        //Texto
        $text.html(data);
    }

    //Mensagem Padronizada exibida depois do envio dos formulários
    function msgSucessFalse(box, data) {
        var $box = $(box);
        var $icon = $(box + " i");
        var $text = $(box + " span");
        $icon.addClass("uk-icon-warning");
        $icon.addClass("uk-icon-small");
        $icon.removeClass("uk-icon-spin");
        $box.addClass("uk-alert-danger");
        $text.html(data);
    }

    //Mensagem de erro Padronizada exibida depois do envio dos formulários
    function msgError(box, data) {
        var $box = $(box);
        var $icon = $(box + " i");
        var $text = $(box + " span");
        $box.removeClass('uk-alert-primary');
        $box.addClass("uk-alert-danger");
        $icon.addClass("uk-icon-warning");
        $icon.removeClass("uk-icon-spin");
        if (data === undefined) {
            $text.html("Erro inesperado, tente novamente.");
        } else {
            $text.html(data);
        }
    }
    /****** MENSAGENS DE CARREGAMENTO AJAX *****/

    /******NOVO*****/
    $(".btn-new").click(function () {
        var item = this.getAttribute("data-item");
        openNew(item);
    });

    openNew = function (item) {
        var modalNew = new UIkit.modal("#box-modal-new");
        var $content = $("#box-modal-new .content-modal");
        $content.html("<i></i><br><span></span>");
        $content.css({"text-align": "center"});
        $.ajax({
            url: root + "new/" + item + "New.php",
            dataType: 'html',
            type: 'POST',
            beforeSend: function () {
                modalNew.show();
                msgBefore("#box-modal-new .content-modal");
            },
            success: function (data, textStatus) {
                $content.css({"text-align": "left"});
                $content.html(data);
                actionsNew(item);

                //BOTÃO CANCELAR
                $(".btn-cancel").click(function () {
                    modalNew.hide();
                    if (item == "address") {
                        listAddress();
                        viewPhoneMain();
                    } else {
                        location.reload();
                    }
                });
            },
            error: function (xhr, er) {
                msgError("#box-modal-new .content-modal");
            }
        });
    };

    actionsNew = function (item) {
        //OUTRAS
        if (item == "city") {
            listPhotos();
            listBanners();
            loadUploadPhotos();
            loadUploadBanner();
            fieldUF("listCitys");
            $(".radio-icon").click(function () {
                $(".lbl-icon").removeClass("active");
                $(this).parent().addClass("active");
            });
            $(".btn-addCity").click(function () {
                openNew('addCity');
            });
        } else if (item == "address") {
            fieldUF("listCitiesFilter");
            addMaskPhone();
        } else if (item == "user") {

        }

        $(".btn-save").click(
                function () {
                    sign(false);
                });

        $(".btn-again").click(
                function () {
                    sign(true);
                });

        //SUBMIT FORM
        var sign = function (signAgain) {
            var modalNew = new UIkit.modal("#box-modal-new");
            var data = $("#new-" + item).serialize();
            $.ajax({
                url: root + "lib/view/new/" + item + ".php",
                dataType: 'html',
                type: 'POST',
                data: data,
                beforeSend: function () {
                    $("#box-result-forms").html("<i></i><br><span></span>");
                    msgBefore("#box-result-forms");
                },
                success: function (data, textStatus) {
                    if (data === "1") {
                        msgSucessTrue("#box-result-forms", "Item adicionado com sucesso.");
                        if (!signAgain) {
                            setTimeout(function () {
                                modalNew.hide();
                                if (item == "address") {
                                    listAddress();
                                    viewPhoneMain();
                                } else {
                                    location.reload();
                                }
                            }, 1000);
                        } else {
                            if (item == "city") {
                                //$("#field-uf").find("option[value='0']").attr("selected", true);
                                //$("#field-city").find("option[value='0']").attr("selected", true);
                                document.getElementById("new-" + item).reset();
                                listPhotos();
                            } else if (item == "category") {
                                $("#name-category").val("");
                                $("input[name='icon-category']").prop('checked', false);
                            } else if (item == "user") {
                                $("#name-user").val("");
                                $("#login-user").val("");
                                $("#pass-user").val("");
                            } else if (item == "address") {
                                document.getElementById("new-" + item).reset();
                                listAddress();
                                viewPhoneMain();
                                $("#name-address").focus();
                            } else if (item == "addCity") {
                                document.getElementById("new-" + item).reset();
                                $("#field-uf").focus();
                            }
                        }
                    } else {
                        msgSucessFalse("#box-result-forms", data);
                    }
                },
                error: function (xhr, er) {
                    msgError("#box-result-forms");
                }
            });
        }

    };

    //SUBMIT FORM EDITA ESTABELECIMENTO
    $("#new-establishment").submit(function () {
        var data = $(this).serialize();
        $.ajax({
            url: root + "lib/view/new/establishment.php",
            dataType: 'html',
            type: 'POST',
            data: data,
            beforeSend: function () {
                $("#box-result-forms-establishment").html("<i></i><br><span></span>");
                msgBefore("#box-result-forms-establishment");
            },
            success: function (data, textStatus) {
                if (data === "1") {
                    msgSucessTrue("#box-result-forms-establishment", "Item adicionado com sucesso.");
                    setTimeout(function () {
                        location.href = root + "estabelecimentos";
                    }, 1000);
                } else {
                    msgSucessFalse("#box-result-forms-establishment", data);
                }
            },
            error: function (xhr, er) {
                msgError("#box-result-forms-establishment");
            }
        });
    });
    viewPhoneMain = function () {
        $.ajax({
            url: root + "lib/view/phoneMain.php",
            dataType: 'html',
            beforeSend: function () {
                $("#phone-main").html("<i></i><br><span></span>");
                msgBefore("#phone-main");
            },
            success: function (data, textStatus) {
                $("#phone-main").html(data);

            },
            error: function (xhr, er) {
                msgError("#phone-main");
            }
        });
    };
    viewPhoneMain();



    /******EDITAR*****/
    $(".btn-edit").click(function () {
        var id = this.getAttribute("data-id");
        var item = this.getAttribute("data-item");
        openEdit(item, id);
    });

    openEdit = function (item, id) {
        var modalEdit = new UIkit.modal("#box-modal-edit");
        var $content = $("#box-modal-edit .content-modal");
        $content.html("<i></i><br><span></span>");
        $content.css({"text-align": "center"});
        $.ajax({
            url: root + "edit/" + item + "Edit.php",
            dataType: 'html',
            type: 'POST',
            data: 'id=' + id,
            beforeSend: function () {
                modalEdit.show();
                msgBefore("#box-modal-edit .content-modal");
            },
            success: function (data, textStatus) {
                $content.css({"text-align": "left"});
                $content.html(data);
                actionsEdit(item, id);

                //BOTÃO CANCELAR
                $(".btn-cancel").click(function () {
                    modalEdit.hide();
                    if (item == "address") {
                        listAddress();
                        viewPhoneMain();
                    } else {
                        location.reload();
                    }
                });
            },
            error: function (xhr, er) {
                msgError("#box-modal-edit .content-modal");
            }
        });
    };

    actionsEdit = function (item, id) {
        //OUTRAS
        if (item == "city") {
            fieldUF("listCitys");
            listPhotos();
            listBanners();
            loadUploadPhotos();
            loadUploadBanner();
            $(".radio-icon").click(function () {
                $(".lbl-icon").removeClass("active");
                $(this).parent().addClass("active");
            });
            $(".btn-editCity").click(function () {
                openEdit('editCity', id);
            });
        } else if (item == "address") {
            fieldUF("listCitiesFilter");
            addMaskPhone();
        }


        //SUBMIT FORM
        $("#edit-" + item).submit(function () {
            var modalEdit = new UIkit.modal("#box-modal-edit");
            var data = $(this).serialize();
            $.ajax({
                url: root + "lib/view/edit/" + item + ".php",
                dataType: 'html',
                type: 'POST',
                data: data,
                beforeSend: function () {
                    $("#box-result-edit").html("<i></i><br><span></span>");
                    msgBefore("#box-result-edit");
                },
                success: function (data, textStatus) {
                    if (data === "1") {
                        msgSucessTrue("#box-result-edit", "Item alterado com sucesso.");
                        setTimeout(function () {
                            modalEdit.hide();
                            if (item == "address") {
                                listAddress();
                                viewPhoneMain();
                            } else {
                                location.reload();
                            }
                        }, 1000);
                    } else {
                        msgSucessFalse("#box-result-edit", data);
                    }
                },
                error: function (xhr, er) {
                    msgError("#box-result-edit");
                }
            });
        });
    };

    //SUBMIT FORM EDITA ESTABELECIMENTO
    $("#edit-establishment").submit(function () {
        var data = $(this).serialize();
        $.ajax({
            url: root + "lib/view/edit/establishment.php",
            dataType: 'html',
            type: 'POST',
            data: data,
            beforeSend: function () {
                $("#box-result-edit-establishment").html("<i></i><br><span></span>");
                msgBefore("#box-result-edit-establishment");
            },
            success: function (data, textStatus) {
                if (data === "1") {
                    msgSucessTrue("#box-result-edit-establishment", "Item alterado com sucesso.");
                    setTimeout(function () {
                        location.href = root + "estabelecimentos";
                    }, 1000);
                } else {
                    msgSucessFalse("#box-result-edit-establishment", data);
                }
            },
            error: function (xhr, er) {
                msgError("#box-result-edit-establishment");
            }
        });
    });

    /**UPLOAD DE FOTOS**/
    loadUploadPhotos = function () {
        var progressbar = $("#progressbar"),
                bar = progressbar.find('.uk-progress-bar'),
                settings = {
                    action: root + '/lib/view/upload.php', // upload url
                    allow: '*.(jpg|jpeg|gif|png)', // allow only images                
                    loadstart: function () {
                        bar.css("width", "0%").text("0%");
                        progressbar.removeClass("uk-hidden");
                    },
                    progress: function (percent) {
                        percent = Math.ceil(percent);
                        bar.css("width", percent + "%").text(percent + "%");
                    },
                    allcomplete: function (response) {
                        bar.css("width", "100%").text("100%");
                        setTimeout(function () {
                            progressbar.addClass("uk-hidden");
                        }, 250);
                        if (response == '1') {
                            listPhotos();
                        } else {
                            alert(response);
                        }
                    }
                };
        var select = UIkit.uploadSelect($("#upload-select"), settings), drop = UIkit.uploadDrop($("#upload-drop"), settings);
    }
    loadUploadPhotos();

    /**UPLOAD DE FOTOS BANNERS**/
    loadUploadBanner = function () {
        var progressbar = $("#progressbar"),
                bar = progressbar.find('.uk-progress-bar'),
                settings = {
                    action: root + '/lib/view/upload.php?item=banner', // upload url
                    allow: '*.(jpg|jpeg|gif|png)', // allow only images                       
                    loadstart: function () {
                        bar.css("width", "0%").text("0%");
                        progressbar.removeClass("uk-hidden");
                    },
                    progress: function (percent) {
                        percent = Math.ceil(percent);
                        bar.css("width", percent + "%").text(percent + "%");
                    },
                    allcomplete: function (response) {
                        bar.css("width", "100%").text("100%");
                        setTimeout(function () {
                            progressbar.addClass("uk-hidden");
                        }, 250);
                        if (response == '1') {
                            listBanners();
                        } else {
                            alert(response);
                        }
                    }
                };
        var select = UIkit.uploadSelect($("#upload-select-banner"), settings), drop = UIkit.uploadDrop($("#upload-drop-banner"), settings);
    }
    loadUploadBanner();

    /**DELETAR FOTOS**/
    deleteQuestionPhotosEstablishment = function (photo) {
        var $box = $("#box-modal-delete .content-modal");
        $box.css({'padding': "10px", "text-align": 'center'});
        var modal = new UIkit.modal("#box-modal-delete");
        var html = "<h2>Você tem certeza que deseja deletar esta foto?</h2>";
        html += "<br>";
        html += "<a href=javascript:void(0); id='btn-yes-delete' class='uk-button uk-button-primary uk-button-large'><i class='uk-icon-check'></i> Sim</a>";
        html += " <a href='javascript:void(0)' class='uk-modal-close uk-button-large uk-button uk-button-danger btn-modal'><i class='uk-icon-close'></i> Não</a>";
        html += "<br><div id='box-result-delete' class='uk-clearfix'></div>";
        $box.html(html);
        $("#btn-yes-delete").click(function () {
            deletePhoto('establishment', photo);
        });
        modal.show();
    };
    deleteQuestionPhotosCity = function (photo) {
        var $box = $("#box-result-forms");
        $box.css({'padding': "10px", "text-align": 'center'});
        $box.addClass("uk-alert");
        $box.addClass("uk-alert-primary");
        var html = "<h2>Você tem certeza que deseja deletar esta foto?</h2>";
        html += "<br>";
        html += "<a href=javascript:void(0); id='btn-yes-delete' class='uk-button uk-button-primary uk-button-large'><i class='uk-icon-check'></i> Sim</a>";
        html += " <a href='javascript:void(0)' id='btn-no-delete' class='uk-button-large uk-button uk-button-danger btn-modal'><i class='uk-icon-close'></i> Não</a>";
        html += "<br><div id='box-result-delete' class='uk-clearfix'></div>";
        $box.html(html);
        $("#btn-yes-delete").click(function () {
            deletePhoto('city', photo);
        });
        $("#btn-no-delete").click(function () {
            $("#box-result-forms").removeClass("uk-alert");
            $("#box-result-forms").removeClass("uk-alert-primary");
            $("#box-result-forms").html(" ");
        });
    };
    deleteQuestionBannerCity = function (photo) {
        var $box = $("#box-result-forms");
        $box.css({'padding': "10px", "text-align": 'center',"font-size":"15px"});
        $box.addClass("uk-alert");
        $box.addClass("uk-alert-primary");
        var html = "<h2>Você tem certeza que deseja deletar este banner?</h2>";
        html += "<br>";
        html += "<a href=javascript:void(0); id='btn-yes-delete' class='uk-button uk-button-primary uk-button-large'><i class='uk-icon-check'></i> Sim</a>";
        html += " <a href='javascript:void(0)' id='btn-no-delete' class='uk-button-large uk-button uk-button-danger btn-modal'><i class='uk-icon-close'></i> Não</a>";
        html += "<br><div id='box-result-delete' class='uk-clearfix'></div>";
        $box.html(html);
        $("#btn-yes-delete").click(function () {
            deletePhoto('banner-city', photo);
        });
        $("#btn-no-delete").click(function () {
            $("#box-result-forms").removeClass("uk-alert");
            $("#box-result-forms").removeClass("uk-alert-primary");
            $("#box-result-forms").html(" ");
        });
    };

    deletePhoto = function (item, photo) {

        $.ajax({
            url: root + "lib/view/delete/photo.php",
            dataType: 'html',
            type: 'POST',
            data: "photo=" + photo,
            beforeSend: function () {
                $("#box-result-delete").html("<i></i><br><span></span>");
                msgBefore("#box-result-delete");
            },
            success: function (data, textStatus) {
                if (data === "1") {
                    msgSucessTrue("#box-result-delete", "Foto deletada com sucesso.");
                    setTimeout(function () {
                        if (item == "establishment") {
                            var modal = new UIkit.modal("#box-modal-delete");
                            modal.hide();
                        } else if (item == "city") {
                            $("#box-result-forms").removeClass("uk-alert");
                            $("#box-result-forms").removeClass("uk-alert-primary");
                            $("#box-result-forms").html(" ");
                        } else {
                            $("#box-result-forms").removeClass("uk-alert");
                            $("#box-result-forms").removeClass("uk-alert-primary");
                            $("#box-result-forms").html(" ");
                        }
                        if (item == "banner-city") {
                            listBanners();
                        } else {
                            listPhotos();
                        }
                    }, 1000);
                } else {
                    msgSucessFalse("#box-result-delete", data);
                }
            },
            error: function (xhr, er) {
                msgError("#box-result-delete");
            }
        });
    }


    /**LISTA FOTOS***/
    listPhotos = function () {
        $.ajax({
            url: root + "lib/view/listPhotos.php",
            dataType: 'html',
            type: 'POST',
            beforeSend: function () {
                $("#box-list-photos").html("<i></i><br><span></span>");
                msgBefore("#box-list-photos");
            },
            success: function (data, textStatus) {
                $("#box-list-photos").html(data);                
                var item = $("#box-list-photos").attr("data-item");
                $(".btn-delete-photo").click(function () {
                    var file = $(this).attr("data-file");
                    if (item == "establishment") {
                        deleteQuestionPhotosEstablishment(file);
                    } else if (item == "city") {
                        deleteQuestionPhotosCity(file);
                    }
                });
            },
            error: function (xhr, er) {
                msgError("#box-list-photos");
            }
        });
    }
    listPhotos();

    /**LISTA FOTOS***/
    listBanners = function () {
        $.ajax({
            url: root + "lib/view/listPhotosBanners.php",
            dataType: 'html',
            type: 'POST',
            beforeSend: function () {
                $("#box-list-photos-banner").html("<i></i><br><span></span>");
                msgBefore("#box-list-photos-banner");
            },
            success: function (data, textStatus) {
                $("#box-list-photos-banner").html(data);
                var item = $("#box-list-photos-banner").attr("data-item");
                $(".btn-delete-photo-banner").click(function () {
                    var file = $(this).attr("data-file");
                    if (item == "city") {
                        deleteQuestionBannerCity(file);
                    }
                });
            },
            error: function (xhr, er) {
                msgError("#box-list-photos");
            }
        });
    }
    listBanners();

    /**LISTA ENDEREÇOS***/
    listAddress = function () {
        $.ajax({
            url: root + "lib/view/listAddress.php",
            dataType: 'html',
            type: 'POST',
            beforeSend: function () {
                $("#box-list-address").html("<i></i><br><span></span>");
                msgBefore("#box-list-address");
            },
            success: function (data, textStatus) {
                $("#box-list-address").html(data);
                $(".btn-edit").click(function () {
                    var id = this.getAttribute("data-id");
                    var item = this.getAttribute("data-item");
                    openEdit(item, id);
                });
                $(".btn-delete").click(function () {
                    var id = this.getAttribute("data-id");
                    var item = this.getAttribute("data-item");
                    deleteQuestion(item, id);
                });
            },
            error: function (xhr, er) {
                msgError("#box-list-address");
            }
        });
    }
    listAddress();

    /***DELETE***/
    $(".btn-delete").click(function () {
        var id = this.getAttribute("data-id");
        var item = this.getAttribute("data-item");
        deleteQuestion(item, id);
    });
    deleteQuestion = function (item, id) {
        var $box = $("#box-modal-delete .content-modal");
        $box.css({'padding': "10px", "text-align": 'center'});
        var modal = new UIkit.modal("#box-modal-delete");
        var html = "<h2>Você tem certeza que deseja desativar este item?</h2>";
        html += "<br>";
        html += "<a href=javascript:void(0); id='btn-yes-delete' class='uk-button uk-button-primary uk-button-large'><i class='uk-icon-check'></i> Sim</a>";
        html += " <a href='javascript:void(0)' class='uk-modal-close uk-button-large uk-button uk-button-danger btn-modal'><i class='uk-icon-close'></i> Não</a>";
        html += "<br><div id='box-result-delete' class='uk-clearfix'></div>";
        $box.html(html);
        $("#btn-yes-delete").click(function () {
            deleteItem(item, id);
        });
        modal.show();
    };

    deleteItem = function (item, id) {
        var modal = new UIkit.modal("#box-modal-delete");
        $.ajax({
            url: root + "lib/view/delete/" + item + ".php",
            dataType: 'html',
            type: 'POST',
            data: "id=" + id,
            beforeSend: function () {
                $("#box-result-delete").html("<i></i><br><span></span>");
                msgBefore("#box-result-delete");
            },
            success: function (data, textStatus) {
                if (data === "1") {
                    msgSucessTrue("#box-result-delete", "Item deletado com sucesso.");
                    setTimeout(function () {
                        modal.hide();
                        if (item == "address") {
                            listAddress();
                            viewPhoneMain();
                        } else {
                            location.reload();
                        }
                    }, 1000);
                } else {
                    msgSucessFalse("#box-result-delete", data);
                }
            },
            error: function (xhr, er) {
                msgError("#box-result-delete");
            }
        });
    }

    //Adiciona um campo de telefone a um endereço
    addPhone = function () {
        var htm = '';
        htm += '<div class="uk-form-icon uk-form-row"><label><input type="checkbox" name="field-main-tf[]"> </label> ';
        htm += '<i class="uk-icon-phone"></i>';
        htm += '<input id="field-tf" name="field-tf[]" class="uk-form-large uk-form-width-medium phone" type="text">';
        htm += '<button onclick="removeItem(this);" type="button" class="uk-button uk-button-large">Remover</button></div>';
        htm += '</div>';

        $(".box-phone").append(htm);
        addMaskPhone();
    };

    //Remove campos de Email ou Telefone
    removeItem = function (btn) {
        var box = btn.parentNode;
        box.remove();
    };

//Adiciona um campo de email a um endereço
    addEmail = function () {
        var htm = '<div class="uk-form-icon uk-form-row">';
        htm += '<i class="uk-icon-envelope-o"></i>';
        htm += '<input id="field-em" name="field-em[]" class="uk-form-large field-email-address" type="email">';
        htm += '<button onclick="removeItem(this);" type="button" class="uk-button uk-button-large">Remover</button></div>';
        htm += '</div>';
        $(".box-email").append(htm)
    };

    //MÃ¡scaras
    /*$('.percent').mask('##0,00', {reverse: true});
     $('.cpf').mask('000.000.000-00', {reverse: true});
     $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
     $('.cep').mask('00000-000');
     $('.date').mask('11/11/1111');*/
    //addMaskPhone();
    function addMaskPhone() {
        var masks = ['(00) 00000-0000', '(00) 0000-00009'];
        $('.phone').mask(masks[1], {onKeyPress: function (val, e, field, options) {
                field.mask(val.length > 14 ? masks[0] : masks[1], options);
            }
        });
    }

    /***Ativar Cidade***/
    $(".btn-alterar").click(function () {
        var id = this.getAttribute("data-id");
        alterQuestion(id);
    });
    alterQuestion = function (id) {
        var $box = $("#box-modal-delete .content-modal");
        $box.css({'padding': "10px", "text-align": 'center'});
        var modal = new UIkit.modal("#box-modal-delete");
        var html = "<h2>Você tem certeza deseja ativar/desativar sincronismo desta cidade?</h2>";
        html += "<br>";
        html += "<a href=javascript:void(0); id='btn-yes-delete' class='uk-button uk-button-primary uk-button-large'><i class='uk-icon-check'></i> Sim</a>";
        html += " <a href='javascript:void(0)' class='uk-modal-close uk-button-large uk-button uk-button-danger btn-modal'><i class='uk-icon-close'></i> Não</a>";
        html += "<br><div id='box-result-delete' class='uk-clearfix'></div>";
        $box.html(html);
        $("#btn-yes-delete").click(function () {
            alterCity(id);
        });
        modal.show();
    };

    alterCity = function (id) {
        var modal = new UIkit.modal("#box-modal-delete");
        $.ajax({
            url: root + "lib/view/alterCity.php",
            dataType: 'html',
            type: 'POST',
            data: "id=" + id,
            beforeSend: function () {
                $("#box-result-delete").html("<i></i><br><span></span>");
                msgBefore("#box-result-delete");
            },
            success: function (data, textStatus) {
                if (data === "1") {
                    msgSucessTrue("#box-result-delete", "Item alterado com sucesso.");
                    setTimeout(function () {
                        modal.hide();
                        location.reload();
                    }, 1000);
                } else {
                    msgSucessFalse("#box-result-delete", data);
                }
            },
            error: function (xhr, er) {
                msgError("#box-result-delete");
            }
        });
    }

    $(".sync").click(function () {
        syncQuestion();
    });


});

