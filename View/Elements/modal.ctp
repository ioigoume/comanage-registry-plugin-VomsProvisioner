<?php

?>

<!-- The Modal -->
<!-- Modal -->
<div class="modal" id="vomsModal" tabindex="-1" role="dialog" aria-labelledby="vomsAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <!--    todo: Put the header in the center    -->
        <h5 class="modal-title-add" id="vomsAddModalLabel"><?php print _txt('fd.voms_provisioner.srv_add'); ?></h5>
        <h5 class="modal-title-edit" id="vomsEditModalLabel"><?php print _txt('fd.voms_provisioner.srv_edit'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php print $this->element('server'); ?>
    </div>
  </div>
</div>
