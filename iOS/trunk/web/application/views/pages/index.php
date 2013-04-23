
<div class="wrapper">
  
  <nav id="menu">
    <ul>
        <li class="">
            <a href="#" class="">Nueva Aplicación</a>
        </li>

        <!-- <li class="">
            <a href="#" class="">Nueva Aplicación</a>
        </li>

        <li class="">
            <a href="#" class="">Nueva Aplicación</a>
        </li> -->
  </nav>

  <div class="main">
    <div class="izq">
      <table>
        <tr>
          <th colspan="5">Aplicaciones</th>
        </tr>
        <?php if(isset($apps))
              {
                for ($i=0; $i <count($apps) ; $i++) 
                  {  
                    ?>
        <tr>
          <td><a href="<?php base_url(); ?>apps/view/<?php echo $apps[$i]['id']; ?>"><?php echo $apps[$i]['nombre']; ?></a></td>
          <td><a href="">Eliminar</a></td>
          <td><a href="">Exportar</a></td>
        </tr>
        <?php } } ?>
      </table>
      
    </div>

    <div class="der">
      <!-- Columan derecha -->
      
    </div>
  </div>

  <div class="clear"></div>

</div>



