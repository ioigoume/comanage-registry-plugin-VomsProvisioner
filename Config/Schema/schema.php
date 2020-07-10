<?php
class AppSchema extends CakeSchema
{

  public function before($event = array())
  {
    return true;
  }

  public function after($event = array())
  {
    if (isset($event['create'])) {
      switch ($event['create']) {
        case 'co_voms_provisioner_targets':
          $VomsProvisioner = ClassRegistry::init('VomsProvisioner.VomsProvisionerTarget');
          $VomsProvisioner->useDbConfig = $this->connection;
          // Add the constraints or any other initializations
          $VomsProvisioner->query("ALTER TABLE ONLY public.cm_co_voms_provisioner_targets ADD CONSTRAINT cm_o_voms_provisioner_targets_co_provisioning_target_id_fkey FOREIGN KEY (co_provisioning_target_id) REFERENCES public.cm_co_provisioning_targets(id)");
          break;
      }
    }
  }

  public $co_voms_provisioner_targets = array(
    'id' => array('type' => 'integer', 'autoIncrement' => true, 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'co_provisioning_target_id' => array('type' => 'integer', 'null' => false, 'length' => 10),
    'host' => array('type' => 'string', 'null' => true, 'length' => 256),
    'port' => array('type' => 'integer', 'null' => true, 'length' => 10),
    'vo' => array('type' => 'string', 'null' => true, 'length' => 96),
    'robot_cert' => array('type' => 'string', 'null' => true, 'length' => 6000),
    'robot_key' => array('type' => 'string', 'null' => true, 'length' => 6000),
    'created' => array('type' => 'datetime', 'null' => true),
    'modified' => array('type' => 'datetime', 'null' => true),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'cm_co_ssh_key_provisioner_targets_i1' => array('column' => 'co_provisioning_target_id', 'unique' => 1),
    )
  );
}