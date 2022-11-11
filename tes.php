<?php
class AlatModel
{
    private $id;
    private $name;



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}


$model = new AlatModel();
$model->setId("1");
$model->setName("press");
// var_dump($model);

$json = json_encode($model);

// $myArray = ["1"=>1,"2"=>2];
$myArray = json_decode(json_encode ( $model ) , true);;

// var_dump($json);
// echo "<br>";

// var_dump($myArray);

// printf($myArray['AlatModelid']);

$txt = "PHP";
// echo "I love $txt!";

$json = file_get_contents('tes.json');
$data = json_decode($json);
// var_dump($data);
echo $data->body[0]->nama;
