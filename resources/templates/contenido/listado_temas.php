<?php

$resultados = TemaManager::obtenerTemasConCountRespuestas();

 ?>

<table class="pure-table">
  <thead>
    <tr>
      <td>Img</td>
      <td>Título</td>
      <td>Nombre del creador</td>
      <td>Fecha de creación</td>
      <td>Número de respuestas</td>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($resultados as $fila) {
        $tema = $fila[0];
        $count = $fila[1];
    ?>
        <tr>
          <td>
            <img class="small-img" src="<?=$tema->getImg()?>" alt="">
          </td>
          <td><a href='listado_respuestas.php?id=<?=$tema->getId()?>'><?=$tema->getTitulo()?></a></td>
          <td><?=$tema->getNombre()?></td>
          <td><?=$tema->getCreado()?></td>
          <td><?=$count?></td>
        </tr>
    <?php } ?>
  </tbody>
</table>
