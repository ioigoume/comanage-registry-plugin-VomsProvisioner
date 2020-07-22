<?php

App::uses("StandardController", "Controller");

class CoVomsProvisionerServersController extends StandardController
{
  // Class name, used by Cake
  public $name = "CoVomsProvisionerServersController";
  // This controller needs a CO to be set
  public $requires_co = true;

  /*
   * By default a new CSRF token is generated for each request, and each token can only be used once.
   * If a token is used twice, the request will be blackholed. Sometimes, this behaviour is not desirable,
   * as it can create issues with single page applications.
   * */
  public $components = array(
    'RequestHandler',
    'Security' => array(
      'csrfUseOnce' => false,
      'csrfExpires' => '+10 minutes'
    ));

  public $uses = array(
    "VomsProvisioner.CoVomsProvisionerTarget",
    "VomsProvisioner.CoVomsProvisionerServer",
    "Co",
  );


  public function delete($id) {
    $this->log(__METHOD__ . "::@", LOG_DEBUG);
    $this->autoRender = false; // We don't render a view in this example
    $this->request->onlyAllow('ajax'); // No direct access via browser URL
    $id = !empty($id) ? $id : $this->request->data['id'];

    if( $this->request->is('ajax') && $this->request->is('delete') ) {
      if( $this->CoVomsProvisionerServer->delete($id)) {
        $resp_data = array(
          'id' => $id,
        );
        $this->response->type('json');
        $this->response->statusCode(200);
        $this->response->body(json_encode($resp_data));
        return $this->response;
      } else {
        $resp_data = array(
          'error' => 'Delete Failed',
        );
        $this->response->type('json');
        $this->response->statusCode(500);
        $this->response->body(json_encode($resp_data));
        return $this->response;
      }
    }
  }


  /**
   *
   */
  public function beforeFilter() {
    // For ajax i accept only json format
    if( $this->request->is('ajax') ) {
      $this->RequestHandler->addInputType('json', array('json_decode', true));
      $this->Security->validatePost = false;
      $this->Security->enabled = true;
      $this->Security->csrfCheck = true;
    }
  }


  /**
   * For Models that accept a CO ID, find the provided CO ID.
   * - precondition: A coid must be provided in $this->request (params or data)
   *
   * @since  COmanage Registry v2.0.0
   * @return Integer The CO ID if found, or -1 if not
   */

  public function parseCOID($data = null) {
    if($this->action == 'add' ||
      $this->action == 'delete') {
      if(isset($this->request->params['named']['co'])) {
        return $this->request->params['named']['co'];
      }
    }
    return parent::parseCOID();
  }

  /**
   * Authorization for this Controller, called by Auth component
   * - precondition: Session.Auth holds data used for auth decisions
   * - postcondition: $permissions set with calculated permissions
   *
   * @since  COmanage Registry v2.0.0
   * @return Array Permissions
   */

  function isAuthorized() {
    $this->log(__METHOD__ . "::@", LOG_DEBUG);
    $roles = $this->Role->calculateCMRoles();

    // Construct the permission set for this user, which will also be passed to the view.
    $p = array();

    // Determine what operations this user can perform
    $p['delete'] = ($roles['cmadmin'] || $roles['coadmin']);
    $this->set('permissions', $p);

    return($p[$this->action]);
  }
}