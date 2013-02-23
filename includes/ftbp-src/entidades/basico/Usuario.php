<?php

/**
 * Classe básica de definicao de usuário
 * @author Luis
 */
class Usuario implements Entidade{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nome;
    
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var List<Notificavel>
     */
    private $notificacoes;
    
    /**
     * @var DateTime
     */
    private $dataCriacao;
    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param integer $id
     */
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * 
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * @param string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }  
    
    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getSenha() {
        return $this->senha;
    }
    
    /**
     * @param string $senha
     */
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    /**
     * @return List<Notificacoes>
     */
    public function getNotificacoes() {
        return $this->notificacoes;
    }
    
    /**
     * @param List<Notificacoes> $notificacoes
     */
    public function setNotificacoes($notificacoes) {
        $this->notificacoes = $notificacoes;
    }
    /**
     * 
     * @param Notificavel $notificacao
     */
    public function addNotificacao(Notificavel $notificacao){
        $this->notificacoes[] = $notificacao;
    }
    
    /**
     * @return DateTime
     */
    public function getDataCriacao() {
        return $this->dataCriacao;
    }
    
    /**
     * @param DateTime $dataCriacao
     */
    public function setDataCriacao(DateTime $dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

}

?>
