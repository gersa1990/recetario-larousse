
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
          <td><a href="#eliminar<?php echo $apps[$i]['id'] ?>">Eliminar</a></td>
          <td><a href="">Exportar</a></td>
        </tr>


        <div id="eliminar<?php echo $apps[$i]['id'] ?>" class="modalDialog">
          <div>
            <a href="#" title="Close" class="close">X</a>
            <?php echo validation_errors(); ?>
            <?php echo form_open('apps/eliminar') ?>
        
              <h2><?php echo $apps[$i]['nombre'] ?><br/></h2>
              <p>Nota: Se eliminaran las recetas relacionadas con esta aplicación.</p>
        
              <input type="hidden" name="id" id="id"  value="<?php echo $apps[$i]['id']; ?>"/>
        
              <button type="submit" class="eliminarBoton">Eliminar</button>
            </form>
          </div>
        </div>

        <?php } } ?>
      </table>
      
    </div>

    <div class="der">
      <!-- Columan derecha -->
      
    </div>
  </div>

  <div class="clear"></div>

</div>



