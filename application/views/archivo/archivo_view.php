<?
/*
<td id="ma">
  <a href="../../uploads/personal/<?=$archivos_varios->fields["url_archivo"]?>" onclick="window.open(this.href, this.target, 'width=800,height=600'); return false;"><img src='<?=$html_root?>/imagenes/page_find.gif' /></a>
</td>
*/

if($archivos)
{
  $id_archivo          = $archivos->row()->id_archivo;
  $id_departamento     = $archivos->row()->id_departamento;
  $id_empresa          = $archivos->row()->id_empresa;
  $id_sub_departamento = $archivos->row()->id_sub_departamento;
  $observacion         = $archivos->row()->observacion;
  $fecha_vigencia      = $this->util->fecha($archivos->row()->fecha_vigencia);
}
else
{
  if( $this->input->cookie('id_departamento',true))
  {
    $id_departamento     = $this->input->cookie('id_departamento',true);
    $id_sub_departamento = $this->input->cookie('id_sub_departamento',true);
  }
}

//si no existe es nuevo
$this->load->helper('cookie');

// if($archivos)
// {
//    $this->util->dump_exit($archivos);
// }
if(!$id_archivo)
{
  $titulo          = "Subir Archivo";
  $id_sub_departamento = 0;
}
else
{
  $titulo = "Modificar Archivo";
}
?>
  <div class="row">
    <div class="col-md-12">
      <h4 class="page-header text-uppercase">
        <?echo $titulo;?>
</h4>
    </div>
  </div><!-- /.row -->
<?php 

echo form_open_multipart('archivo/guardarArchivo', array('id' => 'formulario-archivo')); 

?>

  <div class="row">
    
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="empresa_usuario">Empresa </label>
        <select class="form-control" name="select_empresa" id="select_empresa" autofocus >
          <option value="0">Seleccionar --</option>
          <?
          foreach( $empresas as $empresa ) 
          {
            if($id_empresa==$empresa['id_empresa']||$this->input->cookie('id_empresa',true)==$empresa['id_empresa']) 
              echo "<option value='".$empresa['id_empresa']."' selected >".$empresa['nombre_empresa']."</option>";
            else  
              echo "<option value='".$empresa['id_empresa']."'>".$empresa['nombre_empresa']."</option>";

          }
          ?>          
        </select>
        <input type="hidden" name="id_sub_departamento" value="<? echo $id_sub_departamento;?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe seleccionar una empresa.</p>
      </div>
    </div>
   <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="select_departamento">Departamento</label>
        <input type="hidden" id="cookie_id_departamento" value="<? echo $id_departamento?>" >
        <select class="form-control" name="select_departamento" id="select_departamento"  >
          <option value="0">Seleccionar --</option>
          <?
            foreach( $departamentos as $departamento ) 
            {
              if($id_departamento==$departamento['id_departamento']|| $this->input->cookie('id_departamento',true)==$empresa['id_departamento']) 
                echo "<option value='".$departamento['id_departamento']."' selected >".$departamento['descripcion']."</option>";
              else  
                echo "<option value='".$departamento['id_departamento']."'>".$departamento['descripcion']."</option>";
            }            
          ?> 
        </select>
        <input type="hidden" name="id_departamento" value="<? echo $id_departamento;?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe seleccionar un departamento.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="select_departamento">Sub - Departamento</label>
        <input type="hidden" id="cookie_id_sub_departamento" value="<? echo $id_sub_departamento?>" >
        <select class="form-control" name="select_sub_departamento" id="select_sub_departamento"  >
          <option value="0">Seleccionar --</option>
          <?
            foreach( $departamentos as $departamento ) 
            {
              if($id_departamento==$departamento['id_sub_departamento']|| $this->input->cookie('id_departamento',true)==$empresa['id_departamento']) 
                echo "<option value='".$departamento['id_departamento']."' selected >".$departamento['descripcion']."</option>";
              else  
                echo "<option value='".$departamento['id_departamento']."'>".$departamento['descripcion']."</option>";
            }            
          ?> 
        </select>
        <input type="hidden" name="id_departamento" value="<? echo $id_departamento;?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe seleccionar un departamento.</p>
      </div>
    </div>
  </div><!-- /.row -->
  <br>
  <br>
  <div class="row">
    <div class="col-md-3" >
    </div>
    <div class="col-md-6" align="center" >
      <table align="center" class="table table-bordered">
        <thead class="thead-dark">
          <tr class="table-secondary" bgcolor="#D6D8DA">
            <th scope="col">#</th>
            <th scope="col" align="center">Detalle del Archivo</th>            
          </tr>
        </thead>
        <tr>
          <td width="35%" align="right">
            <b>Fecha de Vigencia</b>
          </td>          
          <td align="center">            
            <input type="text" name='fecha_vigencia' id="fecha_vigencia" autocomplete="off" value='<?echo $fecha_vigencia?>'>
            <p class="text-center help-block hide">Debe seleccionar una fecha.</p>            
          </td>
        </tr>
         <tr>
          <td width="20%" align="right">
            <b>Archivo</b>
          </td>          
          <td align="center">
            <input type="hidden" name='id_archivo' value="0">            
            <input type="file" class="form-control-file" name='userfile' id="archivo">
            <p class="text-center help-block hide">Debe seleccionar un archivo.</p>            
          </td>
        </tr>
         <tr>
          <td width="20%" align="right">
            <b>Observacion</b>
          </td>          
          <td align="center">   
            <textarea class="form-control" name='observacion' id="observacion" rows="3" autocomplete="off" ><?echo $observacion;?></textarea>
            <p class="text-center help-block hide">Debe colocar una observacion.</p>            
          </td>
        </tr>         
      </table>
    </div>
     <div class="col-md-3" >
    </div>
  </div><!-- /.row -->
 
  <div class="row">
    <div class="col-md-12" align="center" >
      <input type="submit" id='id-guardar' value="Guardar" class="btn btn-primary">      
      <span id='id-cargando' class="glyphicon glyphicon-refresh hide"><b><p id='text-cargando'class="text-center help-block hide">Cargando, por favor esperar..</p></b></span>
    </div>
  </div><!-- /.row -->
  <br>
  <br>
  <div class="row">
  <div class="col-md-12 ">
    <table id="datatable-archivo" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>  
          <th>Empresa</th>
          <th>Departamento</th>
          <th>Sub Departamento</th>
          <th>Nombre archivo</th>
          <th>Vigencia</th>
          <th>Observacion</th>
          <th>Ver</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody> 
      <?php 
      foreach( $archivos_dia as $archivo_dia ) { ?>
        <tr>
          <td>
            <?php echo $archivo_dia['nombre_empresa']; ?>
          </td>
          <td>
            <?php echo $archivo_dia['departamento']; ?>
          </td>
          <td>
            <?php echo $archivo_dia['sub_departamento']; ?>
          </td>
          <td>
            <?php echo $archivo_dia['nombre_archivo']; ?>
          </td>
          <td>
            <?php echo Util::fecha($archivo_dia['fecha_vigencia']) ?>
          </td>
          <td>
            <?php echo $archivo_dia['observacion']; ?>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $archivo_dia['id_archivo'] ?>"></div>
            <div class="text-center">
              <?
              // print_r($archivo_dia);exit;
              // http://127.0.0.1/celoma/uploads/1/2/6/academia.jpg
              // http://127.0.0.1/celoma/archivo/D:/www/celoma/uploads/1/2/6/academia.jpg
              $ruta = "../uploads/".$archivo_dia['id_empresa']."/".$archivo_dia['id_departamento']."/".$archivo_dia['id_sub_departamento']."/".$archivo_dia['nombre_archivo'];
              ?>
              <button type="button" class="btn btn-default btn-xs btn-mostrar-archivo" title="Mostrar Archivo">
                 <a href="<?echo $ruta?>" 
                  onclick="window.open(this.href, this.target); return false;">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
              </button>              
            </div>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $archivo_dia['id_archivo'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar" title="Modificar Archivo">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            </div>
          </td>
          <td width="60px">
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-eliminar-archivo" title="Eliminar archivo">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
            </div>
          </td>
        </tr>
      <?php } ?>   
      </tbody>
    </table>
  </div>
</div><!-- /.row-fluid -->
<?php echo form_close(); ?>
