define([
    "jquery",
    "jquery/colorpicker/js/colorpicker"
    ], function ($) {
    'use strict';
    return function(config) {
       var baseUrl = config.baseUrl;
                $(document).ready(function () {
                    $('.add-one').on('click',function(){
                        var val = $('.countval').val();
                        val = parseInt(val)+1;
                        $('.countval').val(val);
                        $('.add-rows').append('<tr class="data-row-'+val+'"><td><div class="admin__field"><div class="admin__field-control"><input type="text" name="title[]" class="title"></div></div></td><td><div class="admin__field"><div class="admin__field-control">  <input type="text" maxlength="6" name="colorSelector[]" class="colorSelector" size="6" id="colorSelector_'+val+'" value="" readonly/></div></div></td><td><div class="admin__field"><div class="admin__field-control">  <input type="number" name="per[]" max="100" min="0" class="per">%</div></div></td><td><button data-val="'+val+'" class="action-delete"><span></span></button></td></tr>');

                        $('#colorSelector_'+val).ColorPicker({
                            onChange: function (hsb, hex, rgb) {
                                $('#colorSelector_'+val).css("backgroundColor", "#" + hex).val("#" + hex);
                            }
                        });
                    });

                    $(document).on('click', '.action-delete', function(){
                        var rowValue = $(this).attr('data-val');
                        $('.data-row-'+rowValue).remove();
                        var val = $('.countval').val();
                        $('.countval').val(parseInt(val)-1);
                    });

                    $('#save_meterial_button').on('click', function(){
                        var productId = $('.productId').val()
                        var title=document.getElementsByName('title[]');
                        var titlearr=new Array();
                        for(var i=0;i<title.length;i++){
                            titlearr[i]=title[i].value;
                        }

                        var colorcodes=document.getElementsByName('colorSelector[]');
                        var colorcodesarr=new Array();
                        for(var i=0;i<colorcodes.length;i++){
                            colorcodesarr[i]=colorcodes[i].value;
                        }

                        var per=document.getElementsByName('per[]');
                        var perarr=new Array();
                        for(var i=0;i<per.length;i++){
                            perarr[i]=per[i].value;
                        }

                        titlearr = JSON.stringify(titlearr);
                        colorcodesarr = JSON.stringify(colorcodesarr);
                        perarr = JSON.stringify(perarr);
                        $.ajax({
                            url: baseUrl + 'materials/index/index',
                            data: {
                                productId: productId,
                                titlearr: titlearr,
                                colorcodesarr: colorcodesarr,
                                perarr: perarr 
                            },
                            showLoader: true,
                            dataType: 'json',
                            type: 'post',
                        }).done(function(data) {
                            var status = data.status;
                            if (status == true) {
                                $('#customMessage').css('display','block');

                                setTimeout(function(){
                                    $("#customMessage").hide('blind', {}, 1000)
                                },2000);

                            }
                        });
                    })
                });
    }
});