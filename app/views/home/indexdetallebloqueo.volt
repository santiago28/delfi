
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Detalle del Bloqueo por contrato</h1>
		<hr> <!-- Footer -->
</div>



<br>


{% if (not(bloqueados is empty)) %}

<h2><?php echo $contrato; ?> <a class="btn btn-default" href="/2016/delfi/home/indexhome" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true" title="Atras"></span></a> </h2>
<br>

<table align="center" class="table table-bordered table-hover" id='table1' style="width: 80%">
                <thead>
                    <tr>
                        <th class="info">Componentes Bloqueados</th>
                        <th class="info">Ene</th>
                        <th class="info">Feb</th>
                        <th class="info">Mar</th>
                        <th class="info">Abr</th>
                        <th class="info">May</th>
                        <th class="info">Jun</th>
                        <th class="info">Jul</th>
                        <th class="info">Ago</th>
                        <th class="info">Sep</th>
                        <th class="info">Oct</th>
                        <th class="info">Nov</th>
                        <th class="info">Dic</th>
                     </tr>
                </thead>
                <tbody>
                    <?php
                    for($i=0;$i<4;$i++) {
                         echo "<tr>";
                         echo "<td>".$bloq_cont_mes[$i][0]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][1]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][2]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][3]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][4]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][5]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][6]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][7]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][8]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][9]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][10]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][11]."</td>";
                         echo "<td>".$bloq_cont_mes[$i][12]."</td>";
                         echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

{% else %}
<p class="alert alert-warning" role="alert" >No hay ningun concepto bloqueado</p>
{% endif %}
<br>









