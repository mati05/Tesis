@extends('template.base_docente')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Evaluación de defensa de título</h2>
    </div>
    <br>

    <!--============================================================ MENSAJES DE ACCION ============================================ -->
        @if (Session::has('message'))
          @if(strcmp(Session::get('tipe_message'), 'danger'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ Session::get('message') }}</strong>
            </div>
          @else
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ Session::get('message') }}</strong>
            </div>
          @endif
        @endif
    <!-- ========================================================================================================================= -->

    <div class="row">
        <center><label>Complete los siguientes parametros para comenzar la evaluación (basta con solo un alumno para cargar el equipo completo)</label></center><br>
        <div class="col-md-12">
            <form  id="eval">
            <div class="row clearfix">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select id="carrera" class="form-control">
                                <option value="">-- Seleccionar Carrera --</option>
                                @foreach($carrera as $d)
                                    <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select id="seccion" class="form-control">
                                <option value="">-- Seleccionar Seccion --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control" id="alumno" name="alumno" required>
                                <option value="">-- Seleccionar Alumno --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" class="btn bg-green waves-effect" onsubmit="guardar(e); return false;">
                    <i class="material-icons">open_in_new</i>
                    <span>Comenzar evaluación</span>
                </button>
            </center>
            </form>
        </div>
    </div>

    <br/><br/>

    <div class="row" style="display: none;" id="evaluacion">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Formulario de evaluacion | Proyecto: "<span id="nombre_proyecto"></span>" | Nota presentación: <span id="nota_proyecto"></span></h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#expo" data-toggle="tab" aria-expanded="false">Exposición</a></li>
                        <li role="presentation" class=""><a href="#demo" data-toggle="tab" aria-expanded="false">Demostración</a></li>
                        <li role="presentation" class=""><a href="#perso1" data-toggle="tab" aria-expanded="false" id="nombre1"></a></li>
                        <li role="presentation" id="personal2" class="">
                            <a href="#perso2" data-toggle="tab" aria-expanded="false" id="nombre2"></a>
                        </li>
                        <li role="presentation" id="personal3" class="">
                            <a href="#perso3" data-toggle="tab" aria-expanded="false" id="nombre3"></a>
                        </li>
                        <li role="presentation" class=""><a href="#resultado" data-toggle="tab" aria-expanded="false">Resultado final</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="expo">
                               
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;"></th>
                                            <th style="width: 22.5%"><center><h6>Item Exposición</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Apoyo adudiovisual</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6> Item Tema expuesto</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Sustentabilidad del proyecto</h6></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Destacado</td>
                                            <td><input name="item_expo" type="radio" id="rbt_1" class="with-gap radio-col-red">
                                            <label for="rbt_1">La exposición considera satisfactoriamente la introducción al tema expuesto, el contexto con la problemática a resolver, el desarrollo de manera articulada y homogénea de la distribución de tiempo de cada integrante, permitiendo la comprensión absoluta del alcance y propósito del proyecto.</label></td>
                                            <td><input name="item_demo" type="radio" id="rbt_5" class="with-gap radio-col-red">
                                            <label for="rbt_5">El apoyo audiovisual satisfactoriamente articula y equilibra los elementos (formato, cantidad de texto, títulos, imagen, color, sonido, transición, animación, etc.) y los párrafos (ortografía, redacción) logrando un absoluto interés en la audiencia.</label></td>
                                            <td><input name="item_tema" type="radio" id="rbt_9" class="with-gap radio-col-red">
                                            <label for="rbt_9">Se presenta de forma satisfactoria el problema (identificación, afectados, justificación), la propuesta de solución (descripción, desarrollo, alcance) y la implementación (forma, alcance), evidenciando una exposición absolutamente técnica y muy detallada.</label></td>
                                            <td><input name="item_sust" type="radio" id="rbt_13" class="with-gap radio-col-red">
                                            <label for="rbt_13">La exposición del proyecto aborda satisfactoriamente la factibilidad técnica (desarrollo, implementación) y económica (desarrollo, implementación) de la solución, presentando un correcto flujo y retorno de la inversión.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Logrado</td>
                                            <td><input name="item_expo" type="radio" id="rbt_2" class="with-gap radio-col-red"/>
                                            <label for="rbt_2">La exposición considera la introducción al tema expuesto, el contexto con la problemática a resolver, el desarrollo de manera articulada y homogénea de la distribución de tiempo de cada integrante, permitiendo la comprensión del alcance y propósito del proyecto.</label></td>
                                            <td><input name="item_demo" type="radio" id="rbt_6" class="with-gap radio-col-red"/>
                                            <label for="rbt_6">El apoyo audiovisual articula y equilibra los elementos (formato, cantidad de texto, títulos, imagen, color, sonido, transición, animación, etc.) y los párrafos (ortografía, redacción) logrando captar gran parte del tiempo el interés en la audiencia.</label></td>
                                            <td><input name="item_tema" type="radio" id="rbt_10" class="with-gap radio-col-red"/>
                                            <label for="rbt_10">Se presenta el problema (identificación, afectados, justificación), la propuesta de solución (descripción, desarrollo, alcance) y la implementación (forma, alcance), evidenciando una exposición técnica y detallada.</label></td>
                                            <td><input name="item_sust" type="radio" id="rbt_14" class="with-gap radio-col-red"/>
                                            <label for="rbt_14">La exposición del proyecto aborda la factibilidad técnica (desarrollo, implementación) y económica (desarrollo, implementación) de la solución, presentando un flujo y retorno de la inversión.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Medianamente logrado</td>
                                            <td><input name="item_expo" type="radio" id="rbt_3" class="with-gap radio-col-red" />
                                            <label for="rbt_3">La exposición contiene aspectos regulares en la introducción al tema expuesto, el contexto con la problemática a resolver, el desarrollo desarticulado de la distribución de tiempo de cada integrante, permitiendo poca comprensión del alcance y propósito del proyecto.</label></td>
                                            <td><input name="item_demo" type="radio" id="rbt_7" class="with-gap radio-col-red"/>
                                            <label for="rbt_7">El apoyo audiovisual regularmente articula o equilibra los elementos (formato, cantidad de texto, títulos, imagen, color, sonido, transición, animación, etc.) y los párrafos (se evidencian algunas faltas ortográficas y de redacción) logrando captar muy poco el interés en la audiencia.</label></td>
                                            <td><input name="item_tema" type="radio" id="rbt_11" class="with-gap radio-col-red"/>
                                            <label for="rbt_11">Se presenta de manera incompleta el problema (identificación, afectados, justificación), la propuesta de solución (descripción, desarrollo, alcance) y la implementación (forma, alcance), evidenciando una escasa exposición técnica y general.</label></td>
                                            <td><input name="item_sust" type="radio" id="rbt_15" class="with-gap radio-col-red"/>
                                            <label for="rbt_15">La exposición del proyecto aborda regularmente la factibilidad técnica (desarrollo, implementación) y económica (desarrollo, implementación) de la solución, presentando un flujo y retorno de la inversión regular.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>No logrado</td>
                                            <td><input name="item_expo" type="radio" id="rbt_4" class="with-gap radio-col-red" checked />
                                            <label for="rbt_4">La exposición carece de introducción al tema expuesto, del contexto con la problemática a resolver, presentando un desarrollo desarticulado y heterogéneo de la distribución de tiempo de cada integrante, generando incomprensión del alcance y propósito del proyecto.</label></td>
                                            <td><input name="item_demo" type="radio" id="rbt_8" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_8">El apoyo audiovisual no articula ni equilibra los elementos (formato, cantidad de texto, imagen, color, sonido, transición, animación, etc.) ni los párrafos (exceso de faltas ortográficas y redacción) logrando nulo interés en la audiencia.</label></td>
                                            <td><input name="item_tema" type="radio" id="rbt_12" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_12">Se presenta de forma insuficiente el problema (identificación, afectados, justificación), la propuesta de solución (descripción, desarrollo, alcance) y la implementación (forma, alcance) evidenciando una exposición general y superficial.</label></td>
                                            <td><input name="item_sust" type="radio" id="rbt_16" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_16">La exposición del proyecto presenta una escasa factibilidad técnica (desarrollo, implementación) y económica (desarrollo, implementación) de la solución, presentando un flujo y retorno de la inversión insuficiente.</label></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4>Puntaje -> : </h4></td>
                                            <td><center><div id="result_item_expo">0.2</div></center></td>
                                            <td><center><div id="result_item_demo">0.2</div></center></td>
                                            <td><center><div id="result_item_tema">0.3</div></center></td>
                                            <td><center><div id="result_item_sust">0.3</div></center></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <h4>NOTA: <div id="nota_evalacion1">1</div></h4>
                            </div>
                            
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="demo">
                            <br>
                            <div class="row">
                                <div class="col-md-5">
                                    <center><h5>Item 1: Presenta Prototipo funcional del Proyecto</h5></center>
                                </div>
                                <div class="col-md-3">
                                    <input name="item_demo1" type="radio" id="rbt_demo1" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo1">Logrado</label><br>
                                    <input name="item_demo1" type="radio" id="rbt_demo2" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo2">Medianamente logrado</label><br>
                                    <input name="item_demo1" type="radio" id="rbt_demo3" class="with-gap radio-col-red" checked />
                                        <label for="rbt_demo3">No logrado</label>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Ponderacion</h6><br>
                                        <h5>20</h5>
                                    </center>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Puntaje</h6><br>
                                        <h5><div id="result_eva_demo1">0</div></h5>
                                    </center>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <center><h5>Item 2: Los sensores ayudan a la automatización en el conteo, ficha medica y toma del peso de cada animal.</h5></center>
                                </div>
                                <div class="col-md-3">
                                    <input name="item_demo2" type="radio" id="rbt_demo4" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo4">Logrado</label><br>
                                    <input name="item_demo2" type="radio" id="rbt_demo5" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo5">Medianamente logrado</label><br>
                                    <input name="item_demo2" type="radio" id="rbt_demo6" class="with-gap radio-col-red" checked />
                                        <label for="rbt_demo6">No logrado</label>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Ponderacion</h6><br>
                                        <h5>20</h5>
                                    </center>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Puntaje</h6><br>
                                        <h5><div id="result_eva_demo2">0</div></h5>
                                    </center>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <center><h5>Item 3: La plataforma ayuda al productor ganadero a una mejor toma de desiciones y tener mayor rentabilidad</h5></center>
                                </div>
                                <div class="col-md-3">
                                    <input name="item_demo3" type="radio" id="rbt_demo7" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo7">Logrado</label><br>
                                    <input name="item_demo3" type="radio" id="rbt_demo8" class="with-gap radio-col-red"/>
                                        <label for="rbt_demo8">Medianamente logrado</label><br>
                                    <input name="item_demo3" type="radio" id="rbt_demo9" class="with-gap radio-col-red" checked />
                                        <label for="rbt_demo9">No logrado</label>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Ponderacion</h6><br>
                                        <h5>60</h5>
                                    </center>
                                </div>
                                <div class="col-md-1">
                                    <center>
                                        <h6>Puntaje</h6><br>
                                        <h5><div id="result_eva_demo3">0</div></h5>
                                    </center>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-2">
                                    <center><h4>Puntaje total: </h4><div id="puntaje_eva_demo">0</div></center>
                                </div>
                                <div class="col-md-2">
                                    <center><h4>Nota: </h4><div id="nota_evalacion2">2.0</div></center>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="perso1">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;"></th>
                                            <th style="width: 22.5%"><center><h6>Item Aspectos generales</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Dominio general del tema</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 1</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 2</h6></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Destacado</td>
                                            <td><input name="item_gen" type="radio" id="rbt_p1" class="with-gap radio-col-red">
                                            <label for="rbt_p1">Dispone una presentación personal apropiada a la solemnidad de la instancia, utiliza lenguaje tecnico de alto nivel y expone con seguridad y  fluidez en el ámbito de su participación en la presentación del proyecto.</label></td>
                                            <td><input name="item_dom" type="radio" id="rbt_p2" class="with-gap radio-col-red">
                                            <label for="rbt_p2">Se observa que responde en forma segura mostrando amplio dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_arg" type="radio" id="rbt_p3" class="with-gap radio-col-red">
                                            <label for="rbt_p3">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_arg2" type="radio" id="rbt_p4" class="with-gap radio-col-red">
                                            <label for="rbt_p4">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Logrado</td>
                                            <td><input name="item_gen" type="radio" id="rbt_p5" class="with-gap radio-col-red"/>
                                            <label for="rbt_p5">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico básico, o bien, expone con seguridad pero sin fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_dom" type="radio" id="rbt_p6" class="with-gap radio-col-red"/>
                                            <label for="rbt_p6">Se observa que responde en forma segura mostrando dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_arg" type="radio" id="rbt_p7" class="with-gap radio-col-red"/>
                                            <label for="rbt_p7">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_arg2" type="radio" id="rbt_p8" class="with-gap radio-col-red"/>
                                            <label for="rbt_p8">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Medianamente logrado</td>
                                            <td><input name="item_gen" type="radio" id="rbt_p9" class="with-gap radio-col-red" />
                                            <label for="rbt_p9">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico pobre, y expone con poca seguridad y fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_dom" type="radio" id="rbt_p10" class="with-gap radio-col-red"/>
                                            <label for="rbt_p10">Se observa que responde en forma titubeante mostrando escaso dominio del tema, si bien complementa la respuesta lo hace de manera poco certera.</label></td>
                                            <td><input name="item_arg" type="radio" id="rbt_p11" class="with-gap radio-col-red"/>
                                            <label for="rbt_p11">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                            <td><input name="item_arg2" type="radio" id="rbt_p12" class="with-gap radio-col-red"/>
                                            <label for="rbt_p12">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>No logrado</td>
                                            <td><input name="item_gen" type="radio" id="rbt_p13" class="with-gap radio-col-red" checked />
                                            <label for="rbt_p13">Dispone una presentación personal inapropiada a la solemnidad de la instancia, no utiliza lenguaje tecnico y expone con total seguridad de manera titubeanten en la presentación del proyecto.</label></td>
                                            <td><input name="item_dom" type="radio" id="rbt_p14" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_p14">Se observa que responde en forma insegura mostrando desconocimiento del tema y no aporta antecedentes complementarios.</label></td>
                                            <td><input name="item_arg" type="radio" id="rbt_p15" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_p15">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                            <td><input name="item_arg2" type="radio" id="rbt_p16" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_p16">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4>Puntaje -> : </h4></td>
                                            <td><center><div id="result_item1_perso1">0.2</div></center></td>
                                            <td><center><div id="result_item2_perso1">0.2</div></center></td>
                                            <td><center><div id="result_item3_perso1">0.3</div></center></td>
                                            <td><center><div id="result_item4_perso1">0.3</div></center></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <h4>NOTA: <div id="nota_evalacion3">1</div></h4>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="perso2">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;"></th>
                                            <th style="width: 22.5%"><center><h6>Item Aspectos generales</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Dominio general del tema</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 1</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 2</h6></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Destacado</td>
                                            <td><input name="item_perso21" type="radio" id="rbt_c1" class="with-gap radio-col-red">
                                            <label for="rbt_c1">Dispone una presentación personal apropiada a la solemnidad de la instancia, utiliza lenguaje tecnico de alto nivel y expone con seguridad y  fluidez en el ámbito de su participación en la presentación del proyecto.</label></td>
                                            <td><input name="item_perso22" type="radio" id="rbt_c2" class="with-gap radio-col-red">
                                            <label for="rbt_c2">Se observa que responde en forma segura mostrando amplio dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_perso23" type="radio" id="rbt_c3" class="with-gap radio-col-red">
                                            <label for="rbt_c3">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_perso24" type="radio" id="rbt_c4" class="with-gap radio-col-red">
                                            <label for="rbt_c4">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Logrado</td>
                                            <td><input name="item_perso21" type="radio" id="rbt_c5" class="with-gap radio-col-red"/>
                                            <label for="rbt_c5">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico básico, o bien, expone con seguridad pero sin fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_perso22" type="radio" id="rbt_c6" class="with-gap radio-col-red"/>
                                            <label for="rbt_c6">Se observa que responde en forma segura mostrando dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_perso23" type="radio" id="rbt_c7" class="with-gap radio-col-red"/>
                                            <label for="rbt_c7">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_perso24" type="radio" id="rbt_c8" class="with-gap radio-col-red"/>
                                            <label for="rbt_c8">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Medianamente logrado</td>
                                            <td><input name="item_perso21" type="radio" id="rbt_c9" class="with-gap radio-col-red" />
                                            <label for="rbt_c9">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico pobre, y expone con poca seguridad y fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_perso22" type="radio" id="rbt_c10" class="with-gap radio-col-red"/>
                                            <label for="rbt_c10">Se observa que responde en forma titubeante mostrando escaso dominio del tema, si bien complementa la respuesta lo hace de manera poco certera.</label></td>
                                            <td><input name="item_perso23" type="radio" id="rbt_c11" class="with-gap radio-col-red"/>
                                            <label for="rbt_c11">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                            <td><input name="item_perso24" type="radio" id="rbt_c12" class="with-gap radio-col-red"/>
                                            <label for="rbt_c12">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>No logrado</td>
                                            <td><input name="item_perso21" type="radio" id="rbt_c13" class="with-gap radio-col-red" checked />
                                            <label for="rbt_c13">Dispone una presentación personal inapropiada a la solemnidad de la instancia, no utiliza lenguaje tecnico y expone con total seguridad de manera titubeanten en la presentación del proyecto.</label></td>
                                            <td><input name="item_perso22" type="radio" id="rbt_c14" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_c14">Se observa que responde en forma insegura mostrando desconocimiento del tema y no aporta antecedentes complementarios.</label></td>
                                            <td><input name="item_perso23" type="radio" id="rbt_c15" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_c15">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                            <td><input name="item_perso24" type="radio" id="rbt_c16" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_c16">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4>Puntaje -> : </h4></td>
                                            <td><center><div id="result_item1_perso2">0.2</div></center></td>
                                            <td><center><div id="result_item2_perso2">0.2</div></center></td>
                                            <td><center><div id="result_item3_perso2">0.3</div></center></td>
                                            <td><center><div id="result_item4_perso2">0.3</div></center></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <h4>NOTA: <div id="nota_evalacion4">1</div></h4>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="perso3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;"></th>
                                            <th style="width: 22.5%"><center><h6>Item Aspectos generales</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Dominio general del tema</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 1</h6></center></th>
                                            <th style="width: 22.5%;"><center><h6>Item Argumentacion de respuesta específica 2</h6></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Destacado</td>
                                            <td><input name="item_perso31" type="radio" id="rbt_d1" class="with-gap radio-col-red">
                                            <label for="rbt_d1">Dispone una presentación personal apropiada a la solemnidad de la instancia, utiliza lenguaje tecnico de alto nivel y expone con seguridad y  fluidez en el ámbito de su participación en la presentación del proyecto.</label></td>
                                            <td><input name="item_perso32" type="radio" id="rbt_d2" class="with-gap radio-col-red">
                                            <label for="rbt_d2">Se observa que responde en forma segura mostrando amplio dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_perso33" type="radio" id="rbt_d3" class="with-gap radio-col-red">
                                            <label for="rbt_d3">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_perso34" type="radio" id="rbt_d4" class="with-gap radio-col-red">
                                            <label for="rbt_d4">Responde de manera acertada, en forma segura, aportando argumentos válidos y precisos, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Logrado</td>
                                            <td><input name="item_perso31" type="radio" id="rbt_d5" class="with-gap radio-col-red"/>
                                            <label for="rbt_d5">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico básico, o bien, expone con seguridad pero sin fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_perso32" type="radio" id="rbt_d6" class="with-gap radio-col-red"/>
                                            <label for="rbt_d6">Se observa que responde en forma segura mostrando dominio del tema, propio de su especialidad, complementa aportando nuevos antecedentes.</label></td>
                                            <td><input name="item_perso33" type="radio" id="rbt_d7" class="with-gap radio-col-red"/>
                                            <label for="rbt_d7">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                            <td><input name="item_perso34" type="radio" id="rbt_d8" class="with-gap radio-col-red"/>
                                            <label for="rbt_d8">Responde de manera acertada, de forma segura, pero no aporta argumentos suficientes, expresando la secuencia de ideas con lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Medianamente logrado</td>
                                            <td><input name="item_perso31" type="radio" id="rbt_d9" class="with-gap radio-col-red" />
                                            <label for="rbt_d9">Dispone una presentación personal apropiada a la solemnidad de la instancia, no obstante, utiliza lenguaje tecnico pobre, y expone con poca seguridad y fluidez  durante la presentación del proyecto.</label></td>
                                            <td><input name="item_perso32" type="radio" id="rbt_d10" class="with-gap radio-col-red"/>
                                            <label for="rbt_d10">Se observa que responde en forma titubeante mostrando escaso dominio del tema, si bien complementa la respuesta lo hace de manera poco certera.</label></td>
                                            <td><input name="item_perso33" type="radio" id="rbt_d11" class="with-gap radio-col-red"/>
                                            <label for="rbt_d11">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                            <td><input name="item_perso34" type="radio" id="rbt_d12" class="with-gap radio-col-red"/>
                                            <label for="rbt_d12">Responde de manera acertada, no obstante no lo hace con seguridad, o bien, no aporta argumentos suficientes, expresando la secuencia de ideas sin lógica y orden.</label></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>No logrado</td>
                                            <td><input name="item_perso31" type="radio" id="rbt_d13" class="with-gap radio-col-red" checked />
                                            <label for="rbt_d13">Dispone una presentación personal inapropiada a la solemnidad de la instancia, no utiliza lenguaje tecnico y expone con total seguridad de manera titubeanten en la presentación del proyecto.</label></td>
                                            <td><input name="item_perso32" type="radio" id="rbt_d14" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_d14">Se observa que responde en forma insegura mostrando desconocimiento del tema y no aporta antecedentes complementarios.</label></td>
                                            <td><input name="item_perso33" type="radio" id="rbt_d15" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_d15">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                            <td><input name="item_perso34" type="radio" id="rbt_d16" class="with-gap radio-col-red" checked/>
                                            <label for="rbt_d16">Responde de manera errónea e insegura, sin argumentar la respuesta, expresando la secuencia de ideas sin lógica ni orden.</label></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><h4>Puntaje -> : </h4></td>
                                            <td><center><div id="result_item1_perso3">0.2</div></center></td>
                                            <td><center><div id="result_item2_perso3">0.2</div></center></td>
                                            <td><center><div id="result_item3_perso3">0.3</div></center></td>
                                            <td><center><div id="result_item4_perso3">0.3</div></center></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <h4>NOTA: <div id="nota_evalacion5">1</div></h4>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="resultado">
                            <br>
                            <!--<center><button type="submit" class="btn bg-green waves-effect">Realizar cálculo de notas</button></center>-->
                            
                        <form action="{{ route('evaluacion_defensa') }}" method="post">@csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Detalle nota grupal</div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th><h6>Evaluación</h6></th>
                                                            <th><h6>Ponderación</h6></th>
                                                            <th><h6>Nota</h6></th>
                                                            <th><h6>Ponderado</h6></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Exposición (grupal)</td>
                                                            <td>25</td>
                                                            <td><div id="nota_evaluacion_exposicion"></div></td>
                                                            <td><div id="ponderado_evaluacion_exposicion"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Demostración (grupal)</td>
                                                            <td>25</td>
                                                            <td><div id="nota_evaluacion_demostracion"></div></td>
                                                            <td><div id="ponderado_evaluacion_demostracion"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Personal - Alumno 1</td>
                                                            <td>50</td>
                                                            <td><div id="nota_evaluacion_personal1"></div></td>
                                                            <td><div id="ponderado_evaluacion_personal1"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Personal - Alumno 2</td>
                                                            <td>50</td>
                                                            <td><div id="nota_evaluacion_personal2"></div></td>
                                                            <td><div id="ponderado_evaluacion_personal2"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Personal - Alumno 3</td>
                                                            <td>50</td>
                                                            <td><div id="nota_evaluacion_personal3"></div></td>
                                                            <td><div id="ponderado_evaluacion_personal3"></div></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Detalle nota individual</div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th><h6>Nombre Alumno</h6></th>
                                                            <th><h6>Nota</h6></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><div id="nombre_i1"></div></td>
                                                            <td><div id="nota_final_alumno1"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><div id="nombre_i2"></div></td>
                                                            <td><div id="nota_final_alumno2"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><div id="nombre_i3"></div></td>
                                                            <td><div id="nota_final_alumno3"></div></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_defensa" id="id_defensa">
                            <input type="hidden" name="alumno1" id="id_alumno1">
                            <input type="hidden" name="alumno2" id="id_alumno2">
                            <input type="hidden" name="alumno3" id="id_alumno3">
                            <input type="hidden" name="nota_eva_expo" id="nota_eva_expo">
                            <input type="hidden" name="nota_eva_demo" id="nota_eva_demo">
                            <input type="hidden" name="nota_eva_perso1" id="nota_eva_perso1">
                            <input type="hidden" name="nota_eva_perso2" id="nota_eva_perso2">
                            <input type="hidden" name="nota_eva_perso3" id="nota_eva_perso3">
                            <input type="hidden" name="nota_final_a1" id="nota_final_a1">
                            <input type="hidden" name="nota_final_a2" id="nota_final_a2">
                            <input type="hidden" name="nota_final_a3" id="nota_final_a3">
                            <center><button type="submit" class="btn bg-green waves-effect">Registrar</button></center>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- FIN DE FORMULARIO EVALUCION -->

</div>


        
@endsection


@section('script_select')
<script type="text/javascript">
    //=============== ALUMNO 1 ======================
    $("#carrera").change(function(){
        var carrera = $(this).val();
        $.get('seccionPorCarrera/'+carrera, function(data){
            $('#seccion').empty();
            $('#seccion').append("<option focus value=''>-- Seleccionar Seccion --</option>");
            $.each(data, function(index, value){
                $('#seccion').append("<option value='"+index+"'>"+value+"</option>");
            })
        });
    });

    $("#seccion").change(function(){
        var seccion = $(this).val();
        $.get('alumnoPorSeccion/'+seccion, function(data2){
            $('#alumno').empty();
            $('#alumno').append("<option focus value=''>-- Seleccionar Alumno --</option>");
            $.each(data2, function(index, value){
                $('#alumno').append("<option value='"+index+"'>"+value+"</option>");
            })
        }).fail(function() {
            alert('Error! No hay alumnos disponibles para esta sección');
            $('#alumno').empty();
            $('#alumno').append("<option focus value=''>-- Seleccionar Alumno --</option>");
        });
    });

    $("#eval").on("submit", function(e) {
        e.preventDefault();
        var id_alumno = document.getElementById("alumno").value;
        //console.log(id_alumno);
        $.get('comenzar_evaluacion/'+id_alumno, 
            function(data){

                var nota_proyecto = data[0]['nota_proyecto'];
                var id_defensa = data[0]['defensa'];
                var asistente = data[0]['asistente'];
                var docente_guia = data[0]['docente_guia'];
                //console.log(asistente+"-"+docente_guia+"-"+<?php echo Auth::user()->id ?>);
                if (nota_proyecto == "") {
                    alert('El proyecto de titulo aún no se ha evaluado. Por favor, evalue para poder continuar');
                    return false;
                }
                else if (id_defensa == "") {
                    alert('Error! no se ha inscrito aún una defensa de titulo. Por favor, debe inscribir una nueva para poder realizar la evaluacion de la misma');
                    return false;
                }
                else if (docente_guia != <?php echo Auth::user()->id ?> && asistente == "") {
                    alert('No tiene permiso para poder evaluar esta defensa de titulo');
                    return false;
                }
                else{
                    var integrante = data[0]['integrantes'].split(", ");
                    var id_integrante = data[0]['id_integrantes'].split(", ");

                    //console.log(integrante.length);
                    document.getElementById('evaluacion').style.display = 'block';
                    document.getElementById('nombre_proyecto').innerHTML = data[0]['nombre_proyecto'];
                    document.getElementById('nota_proyecto').innerHTML = nota_proyecto;
                    $('#id_defensa').val(id_defensa);
                    document.getElementById('nombre1').innerHTML = "Personal - "+integrante[0];
                    $('#id_alumno1').val(id_integrante[0]);
                    document.getElementById('nombre_i1').innerHTML = integrante[0];
                    $(".nav-tabs a[href='#perso2']").hide();
                    $(".nav-tabs a[href='#perso3']").hide();
                        //$( "#expo" ).tabs({ active: 1 });
                        //$("#expo").tabs("option", "selected");
                        //$('[href="#perso3"]').closest('li').hide();
                    if (integrante.length == 2) {
                        //$("#perso2").show();
                        $(".nav-tabs a[href='#perso2']").show();
                        //$("#perso3").hide();
                        //$(".nav-tabs a[href='#perso2']").tab('show');
                        //$('[href="#perso3"]').closest('li').hide();
                        $(".nav-tabs a[href='#perso3']").hide();
                        document.getElementById('nombre2').innerHTML = "Personal - "+integrante[1];
                        document.getElementById('nombre_i2').innerHTML = integrante[1];
                        $('#id_alumno2').val(id_integrante[1]);
                    }
                    else if (integrante.length == 3) {
                        $(".nav-tabs a[href='#perso3']").show();
                        document.getElementById('nombre3').innerHTML = "Personal - "+integrante[2];
                        document.getElementById('nombre_i3').innerHTML = integrante[2];
                        $('#id_alumno3').val(id_integrante[2]);
                    }
                    else{ }
                        //$( "#expo" ).tabs({ active: 0 });
                }
              //  
        }).fail(function() {
            alert('No hay proyectos de titulo para este integrante');
        });

    });

// -------------------------------------------------EVALUACION-------------------------------------------

    $('input[type=radio]').on('change', function() {
        //var nota_item1_eva1 = 0.2; var nota_item2_eva1 = 0.2; var nota_item3_eva1 = 0.3; var nota_item4_eva1 = 0.3; 
        if ($(this).is(':checked') ) {

        // -------------------------------------------------PRIMERA EVALUACION-------------------------------------------
            if ($(this).prop("id") == 'rbt_1') {
               document.getElementById('result_item_expo').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_2') {
               document.getElementById('result_item_expo').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_3') {
               document.getElementById('result_item_expo').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_4') {
                document.getElementById('result_item_expo').innerHTML = 0.2;
            }
            else if ($(this).prop("id") == 'rbt_5') {
                document.getElementById('result_item_demo').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_6') {
                document.getElementById('result_item_demo').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_7') {
                document.getElementById('result_item_demo').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_8') {
                document.getElementById('result_item_demo').innerHTML = 0.2;
            }
            else if ($(this).prop("id") == 'rbt_9') {
                document.getElementById('result_item_tema').innerHTML = 2.1;
            }
            else if ($(this).prop("id") == 'rbt_10') {
                document.getElementById('result_item_tema').innerHTML = 1.5;
            }
            else if ($(this).prop("id") == 'rbt_11') {
                document.getElementById('result_item_tema').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_12') {
                document.getElementById('result_item_tema').innerHTML = 0.3;
            }
            else if ($(this).prop("id") == 'rbt_13') {
                document.getElementById('result_item_sust').innerHTML = 2.1;
            }
            else if ($(this).prop("id") == 'rbt_14') {
                document.getElementById('result_item_sust').innerHTML = 1.5;
            }
            else if ($(this).prop("id") == 'rbt_15') {
                document.getElementById('result_item_sust').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_16') {
                document.getElementById('result_item_sust').innerHTML = 0.3;
            }


        // -------------------------------------------------SEGUNDA EVALUACION-------------------------------------------
            else if ($(this).prop("id") == 'rbt_demo1') {
                document.getElementById('result_eva_demo1').innerHTML = 0.4;
            }
             else if ($(this).prop("id") == 'rbt_demo2') {
                document.getElementById('result_eva_demo1').innerHTML = 0.2;
            }
             else if ($(this).prop("id") == 'rbt_demo3') {
                document.getElementById('result_eva_demo1').innerHTML = 0;
            }
            else if ($(this).prop("id") == 'rbt_demo4') {
                document.getElementById('result_eva_demo2').innerHTML = 0.4;
            }
            else if ($(this).prop("id") == 'rbt_demo5') {
                document.getElementById('result_eva_demo2').innerHTML = 0.2;
            }
            else if ($(this).prop("id") == 'rbt_demo6') {
                document.getElementById('result_eva_demo2').innerHTML = 0;
            }
            else if ($(this).prop("id") == 'rbt_demo7') {
                document.getElementById('result_eva_demo3').innerHTML = 1.2;
            }
            else if ($(this).prop("id") == 'rbt_demo8') {
                document.getElementById('result_eva_demo3').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_demo8') {
                document.getElementById('result_eva_demo3').innerHTML = 0;
            }
            

        // -------------------------------------------------EVALUACION PERSONAL 1-------------------------------------------
            else if ($(this).prop("id") == 'rbt_p1') {
                document.getElementById('result_item1_perso1').innerHTML = 1.4;
            }
             else if ($(this).prop("id") == 'rbt_p5') {
                document.getElementById('result_item1_perso1').innerHTML = 1;
            }
             else if ($(this).prop("id") == 'rbt_p9') {
                document.getElementById('result_item1_perso1').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_p13') {
                document.getElementById('result_item1_perso1').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_p2') {
                document.getElementById('result_item2_perso1').innerHTML = 1.4;
            }
             else if ($(this).prop("id") == 'rbt_p6') {
                document.getElementById('result_item2_perso1').innerHTML = 1;
            }
             else if ($(this).prop("id") == 'rbt_p10') {
                document.getElementById('result_item2_perso1').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_p14') {
                document.getElementById('result_item2_perso1').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_p3') {
                document.getElementById('result_item3_perso1').innerHTML = 2.1;
            }
             else if ($(this).prop("id") == 'rbt_p7') {
                document.getElementById('result_item3_perso1').innerHTML = 1.5;
            }
             else if ($(this).prop("id") == 'rbt_p11') {
                document.getElementById('result_item3_perso1').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_p15') {
                document.getElementById('result_item3_perso1').innerHTML = 0.3;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_p4') {
                document.getElementById('result_item4_perso1').innerHTML = 2.1;
            }
             else if ($(this).prop("id") == 'rbt_p8') {
                document.getElementById('result_item4_perso1').innerHTML = 1.5;
            }
             else if ($(this).prop("id") == 'rbt_p12') {
                document.getElementById('result_item4_perso1').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_p16') {
                document.getElementById('result_item4_perso1').innerHTML = 0.3;
            }


            // -------------------------------------------------EVALUACION PERSONAL 2-------------------------------------------
            else if ($(this).prop("id") == 'rbt_c1') {
                document.getElementById('result_item1_perso2').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_c5') {
                document.getElementById('result_item1_perso2').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_c9') {
                document.getElementById('result_item1_perso2').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_c13') {
                document.getElementById('result_item1_perso2').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_c2') {
                document.getElementById('result_item2_perso2').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_c6') {
                document.getElementById('result_item2_perso2').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_c10') {
                document.getElementById('result_item2_perso2').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_c14') {
                document.getElementById('result_item2_perso2').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_c3') {
                document.getElementById('result_item3_perso2').innerHTML = 2.1;
            }
            else if ($(this).prop("id") == 'rbt_c7') {
                document.getElementById('result_item3_perso2').innerHTML = 1.5;
            }
            else if ($(this).prop("id") == 'rbt_c11') {
                document.getElementById('result_item3_perso2').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_c15') {
                document.getElementById('result_item3_perso2').innerHTML = 0.3;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_c4') {
                document.getElementById('result_item4_perso2').innerHTML = 2.1;
            }
            else if ($(this).prop("id") == 'rbt_c8') {
                document.getElementById('result_item4_perso2').innerHTML = 1.5;
            }
            else if ($(this).prop("id") == 'rbt_c12') {
                document.getElementById('result_item4_perso2').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_c16') {
                document.getElementById('result_item4_perso2').innerHTML = 0.3;
            }



            // -------------------------------------------------EVALUACION PERSONAL 3-------------------------------------------
            else if ($(this).prop("id") == 'rbt_d1') {
                document.getElementById('result_item1_perso3').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_d5') {
                document.getElementById('result_item1_perso3').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_d9') {
                document.getElementById('result_item1_perso3').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_d13') {
                document.getElementById('result_item1_perso3').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_d2') {
                document.getElementById('result_item2_perso3').innerHTML = 1.4;
            }
            else if ($(this).prop("id") == 'rbt_d6') {
                document.getElementById('result_item2_perso3').innerHTML = 1;
            }
            else if ($(this).prop("id") == 'rbt_d10') {
                document.getElementById('result_item2_perso3').innerHTML = 0.6;
            }
            else if ($(this).prop("id") == 'rbt_d14') {
                document.getElementById('result_item2_perso3').innerHTML = 0.2;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_d3') {
                document.getElementById('result_item3_perso3').innerHTML = 2.1;
            }
             else if ($(this).prop("id") == 'rbt_d7') {
                document.getElementById('result_item3_perso3').innerHTML = 1.5;
            }
            else if ($(this).prop("id") == 'rbt_d11') {
                document.getElementById('result_item3_perso3').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_d15') {
                document.getElementById('result_item3_perso3').innerHTML = 0.3;
            }
                    //--------------------------------//
            else if ($(this).prop("id") == 'rbt_d4') {
                document.getElementById('result_item4_perso3').innerHTML = 2.1;
            }
            else if ($(this).prop("id") == 'rbt_d8') {
                document.getElementById('result_item4_perso3').innerHTML = 1.5;
            }
             else if ($(this).prop("id") == 'rbt_d12') {
                document.getElementById('result_item4_perso3').innerHTML = 0.9;
            }
            else if ($(this).prop("id") == 'rbt_d16') {
                document.getElementById('result_item4_perso3').innerHTML = 0.3;
            }


            

        } else { /*console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Deseleccionado");*/ }

        //ITEM EXPOSICION
        var nota_item1_eva1 = document.getElementById('result_item_expo').innerHTML;
        var nota_item2_eva1 = document.getElementById('result_item_demo').innerHTML;
        var nota_item3_eva1 = document.getElementById('result_item_tema').innerHTML;
        var nota_item4_eva1 = document.getElementById('result_item_sust').innerHTML;
        var nota_evalacion1 = parseFloat(nota_item1_eva1)+parseFloat(nota_item2_eva1)+parseFloat(nota_item3_eva1)+parseFloat(nota_item4_eva1);
        document.getElementById('nota_evalacion1').innerHTML = nota_evalacion1.toFixed(1);


        //ITEM DEMOSTRACION
        ponderacion1 = 20; ponderacion2 = 20; ponderacion3 = 60;
        var puntaje_item1 = document.getElementById('result_eva_demo1').innerHTML;
        if (puntaje_item1 == 0.4) { var puntaje_item1 = 1;}
        else if (puntaje_item1 == 0.2) { var puntaje_item1 = 2;}
        var puntaje_item2 = document.getElementById('result_eva_demo2').innerHTML;
        if (puntaje_item2 == 0.4) { var puntaje_item2 = 1;}
        else if (puntaje_item2 == 0.2) { var puntaje_item2 = 2;}
        var puntaje_item3 = document.getElementById('result_eva_demo3').innerHTML;
        if (puntaje_item3 == 1.2) { var puntaje_item3 = 1;}
        else if (puntaje_item3 == 0.6) { var puntaje_item3 = 2;}
        //console.log(puntaje_item1+"-"+puntaje_item2+"-"+puntaje_item3);
        
        if (puntaje_item1 == 0 && puntaje_item2 == 0 && puntaje_item3 == 0) {
            var punt_evalacion2 = 0;
        }
        else if (puntaje_item1 == 0 && puntaje_item2 == 0) {
            var punt_evalacion2 = parseInt(ponderacion3/puntaje_item3);
        }
        else if (puntaje_item1 == 0 && puntaje_item3 == 0) {
            var punt_evalacion2 = parseInt(ponderacion2/puntaje_item2);
        }
        else if (puntaje_item2 == 0 && puntaje_item3 == 0) {
            var punt_evalacion2 = parseInt(ponderacion1/puntaje_item1);
        }
        else if (puntaje_item1 == 0) {
            var punt_evalacion2 = parseInt(ponderacion2/puntaje_item2)+parseInt(ponderacion3/puntaje_item3);
        }
        else if (puntaje_item2 == 0) {
            var punt_evalacion2 = parseInt(ponderacion1/puntaje_item1)+parseInt(ponderacion3/puntaje_item3);
        }
        else if (puntaje_item3 == 0) {
            var punt_evalacion2 = parseInt(ponderacion1/puntaje_item1)+parseInt(ponderacion2/puntaje_item2);
        }
        else{
        var punt_evalacion2 = parseInt(ponderacion1/puntaje_item1)+parseInt(ponderacion2/puntaje_item2)+parseInt(ponderacion3/puntaje_item3);
        }
        document.getElementById('puntaje_eva_demo').innerHTML = punt_evalacion2;
        if (punt_evalacion2 >= 60) {
            var nota_evalacion2 = 3*(punt_evalacion2-60)/(100-60)+4;
        }else{
            var nota_evalacion2 = parseInt(punt_evalacion2)*(4-2)/60+2;
            //console.log(nota_evalacion2);
        }
        //console.log("nota: "+nota_evalacion2);
        document.getElementById('nota_evalacion2').innerHTML = nota_evalacion2.toFixed(1);



         //ITEM EVALUACION PERSONAL 1
        var result_item1_perso1 = document.getElementById('result_item1_perso1').innerHTML;
        var result_item2_perso1 = document.getElementById('result_item2_perso1').innerHTML;
        var result_item3_perso1 = document.getElementById('result_item3_perso1').innerHTML;
        var result_item4_perso1 = document.getElementById('result_item4_perso1').innerHTML;
        var nota_evalacion3 = parseFloat(result_item1_perso1)+parseFloat(result_item2_perso1)+parseFloat(result_item3_perso1)+parseFloat(result_item4_perso1);
        document.getElementById('nota_evalacion3').innerHTML = nota_evalacion3.toFixed(1);


         //ITEM EVALUACION PERSONAL 2
        var result_item1_perso2 = document.getElementById('result_item1_perso2').innerHTML;
        var result_item2_perso2 = document.getElementById('result_item2_perso2').innerHTML;
        var result_item3_perso2 = document.getElementById('result_item3_perso2').innerHTML;
        var result_item4_perso2 = document.getElementById('result_item4_perso2').innerHTML;
        var nota_evalacion4 = parseFloat(result_item1_perso2)+parseFloat(result_item2_perso2)+parseFloat(result_item3_perso2)+parseFloat(result_item4_perso2);
        document.getElementById('nota_evalacion4').innerHTML = nota_evalacion4.toFixed(1);


         //ITEM EVALUACION PERSONAL 3
        var result_item1_perso3 = document.getElementById('result_item1_perso3').innerHTML;
        var result_item2_perso3 = document.getElementById('result_item2_perso3').innerHTML;
        var result_item3_perso3 = document.getElementById('result_item3_perso3').innerHTML;
        var result_item4_perso3 = document.getElementById('result_item4_perso3').innerHTML;
        var nota_evalacion5 = parseFloat(result_item1_perso3)+parseFloat(result_item2_perso3)+parseFloat(result_item3_perso3)+parseFloat(result_item4_perso3);
        document.getElementById('nota_evalacion5').innerHTML = nota_evalacion5.toFixed(1);


        var alumno1 = document.getElementById('nombre_i1').innerHTML;
        var alumno2 = document.getElementById('nombre_i2').innerHTML;
        var alumno3 = document.getElementById('nombre_i3').innerHTML;

        //ITEM RESULTADOS GRUPALES
        document.getElementById('nota_evaluacion_exposicion').innerHTML = nota_evalacion1.toFixed(1);
        document.getElementById('nota_evaluacion_demostracion').innerHTML = nota_evalacion2.toFixed(1);
        document.getElementById('nota_evaluacion_personal1').innerHTML = nota_evalacion3.toFixed(1);



        //ITEM RESULTADOS INDIVIDUAL
        var ponderado_expo = (25*nota_evalacion1)/100;
        var ponderado_demo = (25*nota_evalacion2)/100;
        var ponderado_perso1 = (50*nota_evalacion3)/100;
        document.getElementById('ponderado_evaluacion_exposicion').innerHTML = ponderado_expo.toFixed(1);
        document.getElementById('ponderado_evaluacion_demostracion').innerHTML = ponderado_demo.toFixed(1);
        document.getElementById('ponderado_evaluacion_personal1').innerHTML = ponderado_perso1.toFixed(1);

        document.getElementById('nota_final_alumno1').innerHTML = (ponderado_expo+ponderado_demo+ponderado_perso1).toFixed(1);
        

        if (alumno2.length != 0) {
            document.getElementById('nota_evaluacion_personal2').innerHTML = nota_evalacion4.toFixed(1);
            var ponderado_perso2 = (50*nota_evalacion4)/100;
            document.getElementById('ponderado_evaluacion_personal2').innerHTML = ponderado_perso2.toFixed(1);
            document.getElementById('nota_final_alumno2').innerHTML = (ponderado_expo+ponderado_demo+ponderado_perso2).toFixed(1);
        }
        else if (alumno3.length != 0) {
            document.getElementById('nota_evaluacion_personal3').innerHTML = nota_evalacion5.toFixed(1);
            var ponderado_perso3 = (50*nota_evalacion5)/100;
            document.getElementById('ponderado_evaluacion_personal3').innerHTML = ponderado_perso3.toFixed(1);
            document.getElementById('nota_final_alumno3').innerHTML = (ponderado_expo+ponderado_demo+ponderado_perso3).toFixed(1);
        }


        $('#nota_eva_expo').val(document.getElementById('nota_evaluacion_exposicion').innerHTML);
        $('#nota_eva_demo').val(document.getElementById('nota_evaluacion_demostracion').innerHTML);
        $('#nota_eva_perso1').val(document.getElementById('nota_evaluacion_personal1').innerHTML);
        $('#nota_eva_perso2').val(document.getElementById('nota_evaluacion_personal2').innerHTML);
        $('#nota_eva_perso3').val(document.getElementById('nota_evaluacion_personal3').innerHTML);
        $('#nota_final_a1').val(document.getElementById('nota_final_alumno1').innerHTML);
        $('#nota_final_a2').val(document.getElementById('nota_final_alumno2').innerHTML);
        $('#nota_final_a3').val(document.getElementById('nota_final_alumno3').innerHTML);
        
    });




    
   /* function guardarEvaluacion(){

        var nota_eva_expo = document.getElementById('nota_evaluacion_exposicion').innerHTML;
        var nota_eva_demo = document.getElementById('nota_evaluacion_demostracion').innerHTML;
        var nota_eva_perso1 = document.getElementById('nota_evaluacion_personal1').innerHTML;
        var nota_eva_perso2 = document.getElementById('nota_evaluacion_personal2').innerHTML;
        var nota_eva_perso3 = document.getElementById('nota_evaluacion_personal3').innerHTML;
        var nota_final_a1 = document.getElementById('nota_final_alumno1').innerHTML; 
        var nota_final_a2 = document.getElementById('nota_final_alumno2').innerHTML;
        var nota_final_a3 = document.getElementById('nota_final_alumno3').innerHTML;

        console.log(nota_eva_expo+"-"+nota_eva_demo);
        console.log(" ");
        console.log(nota_eva_perso1+"-"+nota_eva_perso2+"-"+nota_eva_perso3);
        console.log(" ");
        console.log(nota_final_a1+"-"+nota_final_a2+"-"+nota_final_a3);
    } */
    

//----------------------------------------------------------------------------------------------------------------

</script>
@endsection