(function($) {
    var elContainer = document.getElementById("arqueoContainer"),
            $arqSaldo = $("#ArqueoSaldo"),
            $arqInicial = $("#ArqueoImporteInicial"),
            $arqIngreso = $("#ArqueoIngreso"),
            $arqEgreso = $("#ArqueoEgreso"),
            $arqOtrosIngresos = $("#ArqueoOtrosIngresos"),
            $arqOtrosEgresos = $("#ArqueoOtrosEgresos"),
            $arqImporteFinal = $("#ArqueoImporteFinal"),
            classError = 'panel-danger',
            classWarning = 'panel-warning',
            classSuccess = 'panel-success'
            ;


    function $v($el) {
        var val = new Number($el.val());
        return val;
    }


    function toggleClassPorSaldo () {
        var saldo = $arqSaldo.val();
        var $container = $(elContainer);
        if (saldo == 0) {
            $container.removeClass(classWarning);
            $container.removeClass(classError);
            $container.addClass(classSuccess);
        } else {
            if (Math.abs(saldo) < 11) {
                $container.removeClass(classSuccess);
                $container.removeClass(classError);
                $container.addClass(classWarning);
            } else {
                $container.removeClass(classSuccess);
                $container.removeClass(classWarning);
                $container.addClass(classError);
            }
        }
    }
    
    function completarSaldo () {
        var saldo = $v($arqInicial) + $v($arqIngreso) - $v($arqEgreso) + $v($arqOtrosIngresos) - $v($arqOtrosEgresos) - $v($arqImporteFinal);
        $arqSaldo.val(parseInt(saldo*100)/100);
    }

    function calcularSaldo () {
        completarSaldo();
        toggleClassPorSaldo();
    }


    
    

    $(function() {

        function round4ceros( number ){
            var cantCeros = Risto.PRECISION_COMA;
            var multiplicador = Math.pow(10, cantCeros);
            number = parseFloat(number);
            return Math.round( number * multiplicador )/multiplicador;
        }
        
        // imprimir cierre Z en ajax
        $("#btn-imprimir-z").bind('click', function(){
            if ( PrinterDriver.isConnected() ) {
                PrinterDriver.fbrry.bind("fb:rta:dailyClose", function(ob, ev){
                    console.debug("vino un daily close %o", ev.data);
                    if ( ev.data.hasOwnProperty("zeta_numero") ) {
                        var zetaNumero = ev.data["zeta_numero"];
                        $("#zeta-numero").val(zetaNumero);
                    }

                    if ( ev.data.hasOwnProperty("monto_ventas_doc_fiscal") && ev.data.hasOwnProperty("monto_iva_doc_fiscal") ) {
                        var importeTotal = ev.data["monto_ventas_doc_fiscal"];
                        var importeIva = ev.data["monto_iva_doc_fiscal"];
                        var importeNeto = importeTotal-importeIva;
                        $("#zeta-monto-neto").val(round4ceros(importeNeto));
                        $("#zeta-monto-iva").val(round4ceros(importeIva));
                    }

                    if ( ev.data.hasOwnProperty("monto_credito_nc") && ev.data.hasOwnProperty("monto_iva_nc") ) {
                        var importeNcTotal = ev.data["monto_credito_nc"];
                        var importeNcIva = ev.data["monto_iva_nc"];
                        $("#zeta-nc-iva").val(round4ceros(importeNcIva));
                        $("#zeta-nc-neto").val(round4ceros(importeNcTotal));
                    }

                    PrinterDriver.fbrry.unbind("fb:rta:dailyClose");
                });
                PrinterDriver.dailyClose("Z");
            } else {
                // enviar con ajax
                $.get(this.href);
            }
            return false;
        });
        
        
        // recalcular saldo
        $('input','#ArqueoAddForm').bind('keyup', calcularSaldo);
        
        // si es Nuevo arqueo, poner el valor del saldo en su input
        if ((typeof $('#ArqueoId').val() == 'string') && !$('#ArqueoId').val()) {
            completarSaldo();
        }
        
        
        // el boton esta afuera del formulario
        $('#btn-submit').bind('click', function(){
//           $('#ArqueoAddForm').submit();
        });
        
        
        $('#ArqueoAddForm').bind('submit', function() {
            // para que envie el saldo que esta disabled, lo habilito antes del submit
            $(this).find(':input').removeAttr('disabled');
        });


        $("#ArqueoHacerCierreZeta").change(function() {
            if (this.checked) {
                $('.mostrar_zeta').show('fade');
            } else {
                $('.mostrar_zeta').hide('fade');
            }

        });
        
        $("#ArqueoImporteFinal").bind('focus',function(){
            $("#billetines").show('fade');
        });
        
        $('#ZetaMontoNeto').bind('keyup', function(){
            var valor = new Number(this.value);
            $('#ZetaMontoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        $('#ZetaNotaCreditoNeto').bind('keyup', function(){
            var valor = new Number(this.value);
            $('#ZetaNotaCreditoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        
        $billetesValues = $('.billete-value');
        function sumarBilletes(ev){
            var suma = 0;
            for (var i = $billetesValues.length - 1; i >= 0; i--) {
                suma += $billetesValues[i].value * $billetesValues[i].dataset.value;
            }
            
            $('#ArqueoImporteFinal').val(suma);
            $('#ArqueoImporteFinal').trigger('keyup');
        }
        

        $billetesValues.bind('keyup', sumarBilletes);

    });


})(jQuery);
