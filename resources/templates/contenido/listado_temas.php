<?php

$resultados = listadoTemas();

 ?>

<table class="pure-table">
  <thead>
    <tr>
      <td>Título</td>
      <td>Nombre del creador</td>
      <td>Fecha de creación</td>
      <td>Número de respuestas</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($resultados as $fila) { ?>
      <tr>
        <td><?=$fila['titulo']?></td>
        <td><?=$fila['nombre']?></td>
        <td><?=$fila['creado']?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
