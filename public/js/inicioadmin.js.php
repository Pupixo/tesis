<script>
    var url_restapi = "<?php echo site_url(); ?>rest/Restapi/";

    var api_key =  <?php echo "'".API_KEY_SISTEMA."'";  ?>  ;


    function Anio_data_ini(th){
        
            var id_nivel_main = $('#id_nivel_main').val();
            var id_usuario_sesion = $('#id_usuario_sesion').val();  
            var anio = th.value;

                var parametros = {
                        "anio": anio,
                        "id_usuario_sesion":id_usuario_sesion,
                        "id_nivel_main":id_nivel_main,
                    };

                    $.ajax({
                    type  : "POST",
                    url: url_restapi+'data_inicio_by_anio',

                    headers: {
                                    "X-API-KEY":api_key
                    },
                    data  : parametros, 
                    })
                    .done(function(data) {
                     
                        $('#num_total_sy').text(data.syllabus_total);
                        $('#num_plan_estudios').text(data.planestudio_total);


                        $('#plan_estudios_grafica_box .en_revi').text(data.planestudio_est_rev);
                        $('#plan_estudios_grafica_box .aprob').text(data.planestudio_est_acti);
                        $('#plan_estudios_grafica_box .no_aprob').text(data.planestudio_est_anul);

                        $('#syllabus_grafica_box .en_revi').text( data.syllabus_est_rev);
                        $('#syllabus_grafica_box .aprob').text(data.syllabus_est_aprob);
                        $('#syllabus_grafica_box .no_aprob').text( data.syllabus_est_noaprob);

                        setTimeout(function(){

                        $(function () {
                            Circulos_estadistico()
                        })

                        },200);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});    

            
	}

    function Circulos_estadistico(){


           // ==============================================================
                // Campaign
                // ==============================================================

                var chart1 = c3.generate({
                    bindto: '#plan_estudios_grafica',
                    data: {
                        columns: [
                        
                            ['En revisión',  $('#plan_estudios_grafica_box .en_revi').text()],
                            ['Activo', $('#plan_estudios_grafica_box .aprob').text()],
                            ['Anulado',  $('#plan_estudios_grafica_box .no_aprob').text()],
                            // ['Indirect Sales', 15]
                        ],

                        type: 'donut',
                        tooltip: {
                            show: true
                        }
                    },
                    donut: {
                        label: {
                            show: false
                        },
                        title: 'Planes de estudio',
                        width: 30
                    },

                    legend: {
                        hide: true
                    },
                    color: {
                        pattern: [
                            '#01caf1',
                            '#5f76e8',
                            '#ff4f70',
                            '#01caf1'
                        ]
                    }
                });

                d3.select('#plan_estudios_grafica .c3-chart-arcs-title').style('font-family', 'Rubik');

                var chart1 = c3.generate({
                    bindto: '#syllabus_grafica',
                    data: {
                        columns: [
                            ['En revisión',  $('#syllabus_grafica_box .en_revi').text()],
                            ['Aprobado', $('#syllabus_grafica_box .aprob').text()],
                            ['No aprobado',  $('#syllabus_grafica_box .no_aprob').text()],
                            // ['Indirect Sales', 15]
                        ],

                        type: 'donut',
                        tooltip: {
                            show: true
                        }
                    },
                    donut: {
                        label: {
                            show: false
                        },
                        title: 'Syllabus',
                        width: 30
                    },

                    legend: {
                        hide: true
                    },
                    color: {
                        pattern: [
                            '#01caf1',
                            '#5f76e8',
                            '#ff4f70',
                            '#01caf1'
                        ]
                    }
                });

                d3.select('#syllabus_grafica .c3-chart-arcs-title').style('font-family', 'Rubik');

                    // ============================================================== 
                    // income
                    // ============================================================== 
                    // var data = {
                    //     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    //     series: [
                    //         [5, 4, 3, 7, 5, 10]
                    //     ]
                    // };

                    // var options = {
                    //     axisX: {
                    //         showGrid: false
                    //     },
                    //     seriesBarDistance: 1,
                    //     chartPadding: {
                    //         top: 15,
                    //         right: 15,
                    //         bottom: 5,
                    //         left: 0
                    //     },
                    //     plugins: [
                    //         Chartist.plugins.tooltip()
                    //     ],
                    //     width: '100%'
                    // };

                    // var responsiveOptions = [
                    //     ['screen and (max-width: 640px)', {
                    //         seriesBarDistance: 5,
                    //         axisX: {
                    //             labelInterpolationFnc: function (value) {
                    //                 return value[0];
                    //             }
                    //         }
                    //     }]
                    // ];
                    // new Chartist.Bar('.net-income', data, options, responsiveOptions);

                    //     // ============================================================== 
                    //     // Visit By Location
                    //     // ==============================================================
                    // jQuery('#visitbylocate').vectorMap({
                    //     map: 'world_mill_en',
                    //     backgroundColor: 'transparent',
                    //     borderColor: '#000',
                    //     borderOpacity: 0,
                    //     borderWidth: 0,
                    //     zoomOnScroll: false,
                    //     color: '#d5dce5',
                    //     regionStyle: {
                    //         initial: {
                    //             fill: '#d5dce5',
                    //             'stroke-width': 1,
                    //             'stroke': 'rgba(255, 255, 255, 0.5)'
                    //         }
                    //     },
                    //     enableZoom: true,
                    //     hoverColor: '#bdc9d7',
                    //     hoverOpacity: null,
                    //     normalizeFunction: 'linear',
                    //     scaleColors: ['#d5dce5', '#d5dce5'],
                    //     selectedColor: '#bdc9d7',
                    //     selectedRegions: [],
                    //     showTooltip: true,
                    //     onRegionClick: function (element, code, region) {
                    //         var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
                    //         alert(message);
                    //     }
                    // });

                    // // ==============================================================
                    // // Earning Stastics Chart
                    // // ==============================================================
                    // var chart = new Chartist.Line('.stats', {
                    //     labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    //     series: [
                    //         [11, 10, 15, 21, 14, 23, 12]
                    //     ]
                    // }, {
                    //     low: 0,
                    //     high: 28,
                    //     showArea: true,
                    //     fullWidth: true,
                    //     plugins: [
                    //         Chartist.plugins.tooltip()
                    //     ],
                    //     axisY: {
                    //         onlyInteger: true,
                    //         scaleMinSpace: 40,
                    //         offset: 20,
                    //         labelInterpolationFnc: function (value) {
                    //             return (value / 1) + 'k';
                    //         }
                    //     },
                    // });

                    // // Offset x1 a tiny amount so that the straight stroke gets a bounding box
                    // chart.on('draw', function (ctx) {
                    //     if (ctx.type === 'area') {
                    //         ctx.element.attr({
                    //             x1: ctx.x1 + 0.001
                    //         });
                    //     }
                    // });

                    // // Create the gradient definition on created event (always after chart re-render)
                    // chart.on('created', function (ctx) {
                    //     var defs = ctx.svg.elem('defs');
                    //     defs.elem('linearGradient', {
                    //         id: 'gradient',
                    //         x1: 0,
                    //         y1: 1,
                    //         x2: 0,
                    //         y2: 0
                    //     }).elem('stop', {
                    //         offset: 0,
                    //         'stop-color': 'rgba(255, 255, 255, 1)'
                    //     }).parent().elem('stop', {
                    //         offset: 1,
                    //         'stop-color': 'rgba(80, 153, 255, 1)'
                    //     });
                    // });

                    // $(window).on('resize', function () {
                    //     chart.update();
                    // });
      

    }

    $(document).ready(function() {

        $("#cbx_basicos_periodo_anio").select2();
            setTimeout(function(){

            $(function () {
                Circulos_estadistico()
            })
                                            
            },1000);
    });


</script>