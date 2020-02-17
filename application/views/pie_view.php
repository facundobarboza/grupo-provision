<footer style="background-color:#dcdcdc; padding: 10px 0; margin-top: 30px;">
  <p class="text-center" style="margin:0;">
    Derechos Reservados &copy; - <?php echo date('Y'); ?> <strong>Grupo Provision S.R.L</strong> 
  </p>

<?php if( ENVIRONMENT === 'development' ) { ?>
  <div class="row">
    <div class="col-md-2">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2" class="text-center">Codeigniter</th>
          </tr>
          <tr>
            <th>Versi&oacute;n</th>
            <th>Entorno</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo CI_VERSION ?></td>
            <td><?php echo ENVIRONMENT ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-5">
      <table class="table">
        <thead>
          <tr>
            <th colspan="3" class="text-center">PHP</th>
          </tr>
          <tr>
            <th>Memoria</th>
            <th>Renderizado</th>
            <th>Versión</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $this->benchmark->memory_usage(); ?></td>
            <td><?php echo $this->benchmark->elapsed_time(); ?> segundos</td>
            <td><?php echo phpversion(); ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-5">
      <table class="table">
        <thead>
          <tr>
            <th colspan="3" class="text-center">Base de Datos</th>
          </tr>
          <tr>
            <th>Hostname</th>
            <th>Database</th>
            <th>Char-Set</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $this->db->hostname ?></td>
            <td><?php echo $this->db->database ?></td>
            <td><?php echo $this->db->char_set ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <?php } ?>
</footer>