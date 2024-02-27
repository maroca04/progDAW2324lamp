<?php
class Cartera{
private $clientes=[];
private $fichero;

function __construct($fichero){
    $this->fichero=$fichero;
    $this-> loadData($fichero);
}
public function loadData($fichero)
    {
        $gestor = fopen($fichero, "r");
        while (($element = fgetcsv($gestor)) !== false) {
            array_push(
                $this->clientes,
                new Empresa(...$element) //Spread Operator
            );
        }
        fclose($gestor);
    }


	public function isVIP($investment){
        return $investment >= 1000000;
    }
    public function drawlist()
    {
        $html = "";
        foreach ($this->clientes as $Cliente) {
            $styleClass = '';

            if ($this->isVIP($Cliente->getInvestment())) {
                $styleClass = 'vip';
            }

            $html .= '<tr ' . $styleClass . '>';
            $html .= '<td>' . $Cliente->getId() . '</td>';
            $html .= '<td class=' . $styleClass . '>' . $Cliente->getCompany() .'</td>';
            $html .= '<td>' . $Cliente->getInvestment() . '€' . '</td>';
            $html .= '<td>' . $Cliente->getDate() . '</td>';

           
            if ($Cliente->getActive() == 'True') {
                $html .= '<td><img src="img/img05.gif"></td>';
            } else {
                $html .= '<td><img src="img/img06.gif" ></td>';
            }
            $html .= '<td><a href="delete.php?id=' . $Cliente->getId() . '"><img src="img/del_icon.png" width="25"></a></td>';

            $html .= '<td><a href="edit.php?id=' . $Cliente->getId() . '"><img src="img/edit_icon.png" width="25"></a></td>';
            $html .= '<td><a href="insert.php?id=' . $Cliente->getId() . '"><img src="img/ins_icon.png" width="25"></a></td>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        return $html;
    }
    function delete($idEmpresa){
        for ($i = 0; $i < count($this->clientes); $i++){
            if($this->clientes[$i]->getId() == $idEmpresa){
                array_splice($this->clientes, $i, 1);
            }
        }
        $this->persist();
    }
    
    function persist(){
    $gestor = fopen("data.csv", "w");
    foreach ($this->clientes as $cliente ) {

        fputcsv($gestor,[
            $cliente->getId(),
            $cliente->getCompany(),
            $cliente->getInvestment(),
            $cliente->getDate(),
            $cliente->getActive()
        ]);
    
        }

        fclose($gestor);

    }

    function getClient($id){
        foreach ($this->clientes as $cliente) {
            if($cliente->getId()==$id){
                return $cliente;
            }
        }
    }
    function update($datos){

        foreach ($this->clientes as $client) {
            if ($client->getId() == $datos["id"]) {
                $client->setCompany($datos["company"]);
                $client->setInvestment($datos["investment"]);
                $client->setDate($datos["date"]);
                $client->setActive($datos["active"]);
            }
        }
        $this->persist();
    }
    function insert($datos){
        $clase=new Empresa($datos["id"],$datos["company"],$datos["investment"],$datos["date"],$datos["active"]);
        
        array_push($this->clientes,$clase);
        
        $this->persist();
    }

}