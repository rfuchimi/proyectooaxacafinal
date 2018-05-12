<div class="mapcontainer">
    <div class="map">
        <span>Alternative content for the map</span>
    </div>
    <div class="areaLegend"></div>
    <div class="plotLegend"></div>
</div>
<link href="assets/css/mapael/estilo_mapael.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/js/mapael/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="assets/js/mapael/jquery.mousewheel.min.js" charset="utf-8"></script>
<script type="text/javascript" src="assets/js/mapael/raphael.min.js" charset="utf-8"></script>
<script type="text/javascript" src="assets/js/mapael/jquery.mapael.min.js" charset="utf-8"></script>
<script type="text/javascript" src="assets/js/mapael/mexico.js" charset="utf-8"></script>

<script type="text/javascript">
$(".mapcontainer").mapael(
{
    "map": {
        "name" : "mexico",
        "zoom": {
            "enabled": true,
            "maxLevel": 10
        }
    },
    legend : {
        area : {
            display : true,
            title :"Regiones de venta Telcel", 
            mode:"horizontal",
            slices : [
                {
                    max : 1,
                    min : 1, 
                    attrs : {
                        fill : "#cfb3b2"
                    },
                    label :"R1 BCN, BCS",
                    width: 10
                },
                {
                    max : 2,
                    min : 2, 
                    attrs : {
                        fill : "#fdffb1"
                    },
                    label :"R2 Sonora y sinaloa"
                },
                {
                    max : 3,
                    min : 3, 
                    attrs : {
                        fill : "#acefff"
                    },
                    label :"R3 Chihuahua y Durango"
                },
                {
                    max : 4,
                    min : 4, 
                    attrs : {
                        fill : "#83cd9a"
                    },
                    label :"R4 Coahuila, Nuevo León y Tamaulipas"
                },
                {
                    max : 5,
                    min : 5, 
                    attrs : {
                        fill : "#cb8cb7"
                    },
                    label :"R5 Nayarit, Jalisco, Colima y Michoacán"
                },
                {
                    max : 6,
                    min : 6, 
                    attrs : {
                        fill : "#96b8de"
                    },
                    label :"R6 Zacatecas, San Luis Potosi, Aguascalientes, Guanajuato y Queretaro Norte"
                },
                {
                    max : 7,
                    min : 7, 
                    attrs : {
                        fill : "#c5b0fe"
                    },
                    label :"R7 Guerrero, Tlaxcala, Puebla, Veracruz, y Oaxaca"
                },
                {
                    max : 8,
                    min : 8, 
                    attrs : {
                        fill : "#f6949c"
                    },
                    label :"R8 Tabasco, Chiapas, Campeche, Yucatán y Quintana Roo"
                },
                {
                    max : 9,
                    min : 9, 
                    attrs : {
                        fill : "#01e751"
                    },
                    label :"R9 Queretaro Sur, Hidalgo, Morelos, Estado de México y Ciudad de México"
                }
            ]
        }
    },
    areas: {
        "hidalgo": {
            value: "9",
            href : "#",
            tooltip: {content : "<span style=\"font-weight:bold;\">R9</span><br />Hidalgo"}
        },
         "puebla": {
            value: "8",
            href : "#",
            tooltip: {content : "<span style=\"font-weight:bold;\">R9</span><br />Hidalgo"}
        }
    }
}
)

</script>
<script type="text/javascript">
varvar jsonObj  jsonObj = {
    members: 
           {
            host: "hostName",
            viewers: 
            {
                user1: "value1",
                user2: "value2",
                user3: "value3"
            }
        }
}

var i;

for(i=4; i<=8; i++){
    var newUser = "user" + i;
    var newValue = "value" + i;
    jsonObj.members.viewers[newUser] = newValue ;

}

console.log(jsonObj);

</script>

<?php
/*$query = $this->db->query('SELECT est_nombre,reg_id,reg_nombre
                               FROM cat_estado
                               inner join cat_coordenada using (est_id)
                               inner join cat_region using (reg_id);
');
$areas = array();
foreach ($query->result() as $row) 
{ 

echo $row->est_nombre; 
echo $row->reg_id; 
echo $row->reg_nombre; 

$clientes[] = array('id'=> $id, 'nombre'=> $nombre, 'edad'=> $edad, 'genero'=> $genero,
                        'email'=> $email, 'localidad'=> $localidad, 'telefono'=> $telefono);
} 

$json_string = json_encode($clientes);
echo $json_string;*/
?>