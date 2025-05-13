<?php

// Class abstratada para "moldar" e dar uma ideia do funcionamento de suas classes filhas
abstract class funcionarios {
    // Tudo que herdar essa class abstrata obrigatoriamente terá seus métodos

    protected $nome;
    protected $salarioPorHora;
    protected $horasDeTrabalho;
    protected $horasTrabalhadas;

    protected $estaTrabalhando;


    public function __construct(string $nome, float $salarioPorHora, float $horasDeTrabalho, float $horasTrabalhadas)
    {
        $this->nome = $nome;
        $this->salarioPorHora = $salarioPorHora;
        $this->horasDeTrabalho = $horasDeTrabalho;
        $this->horasTrabalhadas = $horasTrabalhadas;
    }
    
    // Getters
    public function getNome() : string{
        return $this->nome;
    }

    public function getSalarioPorHora() : float{
        return $this->salarioPorHora;
    }

    public function getSalarioMensal() : float{
        return $this->getSalarioPorHora() * $this->getHorasDeTrabalho() * 30;
    }

    public function getHorasTrabalhadas() : float{
        return $this->horasTrabalhadas;
    }

    public function getHorasDeTrabalho() : float{
        return $this->horasDeTrabalho;
    }

    // Setters

    public function setSalarioPorHora($newSalarioPorHora) : void {
        if ($newSalarioPorHora > 0) {
            $this->salarioPorHora = $newSalarioPorHora;
        }
    }

    // Métodos concretos
    public function baterPonto() {
        echo "<strong>$this->nome registrou o ponto</strong>";
        $this->estaTrabalhando = !($this->estaTrabalhando);
    }

    public function estaTrabalhando() : bool{
        return $this->estaTrabalhando;
    }

    public function verificarHoraExtra() : bool {
        if ($this->horasTrabalhadas > $this-> horasDeTrabalho) {
            return true;
        } else {
            return false;
        }
    }

    // Métodos abstrato
    public abstract function trabalho(); // Especifica o tipo de trabalho do funcionário
}

class Gerente extends funcionarios {
    public function trabalho() {
        echo $this->getNome() , " Trabalha como gerente <br>";
    }
}

class Programador extends funcionarios {
    private $linguagem;

    public function __construct(string $nome, float $salarioPorHora, float $horasDeTrabalho, float $horasTrabalhadas, string $linguagem)
    {
        parent::__construct($nome, $salarioPorHora, $horasDeTrabalho, $horasTrabalhadas);
        $this->linguagem = $linguagem;
    }

    // Get

    public function getLinguagem() : string{
        return $this->linguagem;
    }

    public function trabalho()
    {
        echo $this->getNome() , " Trabalha como programador <br>";
    }
}

// Testes

$gerente1 = new Gerente("Marcos", 160, 8, 6);
$programador1 = new Programador("Daniel", 50, 8, 10, "PHP, Python");
$programador2 = new Programador("Sophia", 50, 8, 6, "PHP");

// Gerente 1
echo "
<h1> Gerente </h1>", 
    $gerente1->baterPonto() , 
"<br>", 
    $gerente1->trabalho(), 
"<br> Seu tempo de trabalho é de <strong>", $gerente1->getHorasDeTrabalho() ," horas</strong> e ele trabalhou um total de <strong>", $gerente1->getHorasTrabalhadas()," horas</strong>", 
"<br> Salário: <strong>", $gerente1->getSalarioMensal(), "</strong> <br> No momento ", ($gerente1->estaTrabalhando())? "está  trabalhando" : "Não está trabalhando";
    
// Programador 1
echo "
<h1> Programador </h1>", 
    $programador1->baterPonto() ,
    "<br>", 
    $programador1->baterPonto() , 
"<br>", 
    $programador1->trabalho(), 
"<br> Seu tempo de trabalho é de <strong>", $programador1->getHorasDeTrabalho() ," horas</strong> e ele trabalhou um total de <strong>", $programador1->getHorasTrabalhadas()," horas</strong>", 
"<br> Salário: <strong>", $programador1->getSalarioMensal(), "</strong> <br> No momento ", ($programador1->estaTrabalhando())? "está  trabalhando" : "Não está trabalhando";

// Programador 2
echo "
<br><br> ", 
    $programador2->baterPonto() ,
"<br>", 
    $programador2->trabalho(), 
"<br> Seu tempo de trabalho é de <strong>", $programador2->getHorasDeTrabalho() ," horas</strong> e ele trabalhou um total de <strong>", $programador2->getHorasTrabalhadas()," horas</strong>", 
"<br> Salário: <strong>", $programador2->getSalarioMensal(), "</strong> <br> No momento ", ($programador2->estaTrabalhando())? "Está  trabalhando" : "Não está trabalhando";
?>