<?php
// ==================================
// SISTEMA DE LOCADORA DE VEÍCULOS
// ==================================

// Classe abstrata
abstract class Veiculo {
    private $modelo;
    private $placa;
    private $disponivel;

    public function __construct($modelo, $placa) {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->disponivel = true;
    }

    abstract public function calcularAluguel(int $dias): float;

    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    public function getModelo(): string {
        return $this->modelo;
    }

    public function alugar(): bool {
        if ($this->disponivel) {
            $this->disponivel = false;
            return true;
        }
        return false;
    }

    public function devolver() {
        $this->disponivel = true;
    }
}

// Classe Carro
class Carro extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 100.00;
    }
}

// Classe Moto
class Moto extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 50.00;
    }
}

// Classe Locadora
class Locadora {
    private $veiculos = [];

    public function adicionarVeiculo(Veiculo $veiculo) {
        $this->veiculos[$veiculo->getModelo()] = $veiculo;
        echo "Veículo '{$veiculo->getModelo()}' adicionado ao acervo.<br>";
    }

    public function alugarVeiculo(string $modelo) {
        if (isset($this->veiculos[$modelo])) {
            $veiculo = $this->veiculos[$modelo];
            if ($veiculo->alugar()) {
                $tipo = get_class($veiculo);
                echo "$tipo '{$modelo}' alugado com sucesso!<br>";
            } else {
                echo "O veículo '{$modelo}' já está alugado.<br>";
            }
        } else {
            echo "Veículo '{$modelo}' não encontrado.<br>";
        }
    }

    public function devolverVeiculo(string $modelo) {
        if (isset($this->veiculos[$modelo])) {
            $this->veiculos[$modelo]->devolver();
            $tipo = get_class($this->veiculos[$modelo]);
            echo "$tipo '{$modelo}' devolvido com sucesso!<br>";
        } else {
            echo "Veículo '{$modelo}' não encontrado.<br>";
        }
    }

    public function calcularValorAluguel(string $modelo, int $dias) {
        if (isset($this->veiculos[$modelo])) {
            $valor = $this->veiculos[$modelo]->calcularAluguel($dias);
            $tipo = get_class($this->veiculos[$modelo]);
            echo "Valor do aluguel do " . strtolower($tipo) . " por $dias dias: R$" . number_format($valor, 2) . "<br>";
        }
    }
}

// Simulação
$locadora = new Locadora();

$carro = new Carro("HB20", "ABC1234");
$moto = new Moto("Yamaha XTZ", "XYZ9876");

$locadora->adicionarVeiculo($carro);
$locadora->adicionarVeiculo($moto);

echo "<br>";

$locadora->alugarVeiculo("HB20");
$locadora->alugarVeiculo("Yamaha XTZ");

echo "<br>";

$locadora->devolverVeiculo("HB20");

echo "<br>";

$locadora->calcularValorAluguel("HB20", 3);
$locadora->calcularValorAluguel("Yamaha XTZ", 3);
?>
