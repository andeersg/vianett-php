<?php

/**
 *
 */
class ViaNett_Send extends ViaNett_Client {

  private $sender;
  private $receiver;
  private $message;
  private $messageId;

  /**
   * @return bool
   * @throws \Exception
   */
  public function send() {
    $url = $this->prepareUrl();
    return $this->doRequest($url);
  }

  /**
   * @return string
   */
  public function debug() {
    return $this->prepareUrl();
  }

  /**
   * @param $sender
   */
  public function setSender($sender) {
    $this->sender = $sender;
  }

  /**
   * @param $receiver
   */
  public function setReceiver($receiver) {
    $this->receiver = $receiver;
  }

  /**
   * @param $message
   */
  public function setMessage($message) {
    $this->message = $message;
  }

  /**
   * @param $messageId
   */
  public function setMessageId($messageId) {
    $this->messageId = $messageId;
  }

  /**
   * @param $sender
   * @param $receiver
   * @param $message
   * @param $message_id
   */
  public function prepareSMS($sender, $receiver, $message, $message_id) {
    $this->setSender($sender);
    $this->setReceiver($receiver);
    $this->setMessage($message);
    $this->setMessageId($message_id);
  }

  /**
   * @throws \Exception
   */
  private function doValidation() {
    if (!$this->sender) {
      throw new Exception('Missing sender value.');
    }
    if (!$this->receiver) {
      throw new Exception('Missing receiver value.');
    }
    if (!$this->message) {
      throw new Exception('Missing message value.');
    }
    if (!$this->messageId) {
      throw new Exception('Missing message id value.');
    }
  }

  /**
   * @return string
   * @throws \Exception
   */
  protected function prepareUrl() {
    $this->doValidation();
    $url = 'username=%s&password=%s&SenderAddress=%s&tel=%s&msg=%s&msgid=%s';
    return sprintf(
      $url,
      urlencode($this->getUsername()),
      urlencode($this->getPassword()),
      urlencode($this->sender),
      urlencode($this->receiver),
      urlencode($this->message),
      urlencode($this->messageId)
    );
  }
}
