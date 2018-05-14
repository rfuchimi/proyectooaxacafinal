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
        "name": "mexico",
        "zoom": {
            "enabled": "true",
            "maxLevel": 10
        }
    },
    "legend": {
        "area": {
            "display": true,
            "title": "REGIONES DE VENTA TELCEL",
            "mode": "horizontal",
            "slices": [
                {
                    "max": "1",
                    "min": "1",
                    "attrs": {
                        "fill": "#CFB3B2"
                    },
                    "label": "R1 - BCN, BCS"
                },
                {
                    "max": "2",
                    "min": "2",
                    "attrs": {
                        "fill": "#FDFFB1"
                    },
                    "label": "R2 - SIN, SON"
                },
                {
                    "max": "3",
                    "min": "3",
                    "attrs": {
                        "fill": "#ACEFFF"
                    },
                    "label": "R3 - CHH, DUR"
                },
                {
                    "max": "4",
                    "min": "4",
                    "attrs": {
                        "fill": "#83CD9A"
                    },
                    "label": "R4 - COA, NLE, TAM"
                },
                {
                    "max": "5",
                    "min": "5",
                    "attrs": {
                        "fill": "#CB8CB7"
                    },
                    "label": "R5 - COL, HID, JAL, MIC, NAY"
                },
                {
                    "max": "6",
                    "min": "6",
                    "attrs": {
                        "fill": "#96B8DE"
                    },
                    "label": "R6 - AGU, GUA, QUE, SLP, ZAC"
                },
                {
                    "max": "7",
                    "min": "7",
                    "attrs": {
                        "fill": "#C5B0FE"
                    },
                    "label": "R7 - GRO, OAX, PUE, TLA, VER"
                },
                {
                    "max": "8",
                    "min": "8",
                    "attrs": {
                        "fill": "#F6949C"
                    },
                    "label": "R8 - CAM, CHP, ROO, TAB, YUC"
                },
                {
                    "max": "9",
                    "min": "9",
                    "attrs": {
                        "fill": "#01E751"
                    },
                    "label": "R9 - CMX, MEX, MOR"
                }
            ]
        }
    },
    "areas": {
        "AGUASCALIENTES": {
            "value": "6",
            "href": "#",
            "tooltip": {
                "content": "6<br>AGUASCALIENTES"
            }
        },
        "BAJA CALIFORNIA NORTE": {
            "value": "1",
            "href": "#",
            "tooltip": {
                "content": "1<br>BAJA CALIFORNIA NORTE"
            }
        },
        "BAJA CALIFORNIA SUR": {
            "value": "1",
            "href": "#",
            "tooltip": {
                "content": "1<br>BAJA CALIFORNIA SUR"
            }
        },
        "CAMPECHE": {
            "value": "8",
            "href": "#",
            "tooltip": {
                "content": "8<br>CAMPECHE"
            }
        },
        "CHIAPAS": {
            "value": "8",
            "href": "#",
            "tooltip": {
                "content": "8<br>CHIAPAS"
            }
        },
        "CHIHUAHUA": {
            "value": "3",
            "href": "#",
            "tooltip": {
                "content": "3<br>CHIHUAHUA"
            }
        },
        "CIUDAD DE MEXICO": {
            "value": "9",
            "href": "#",
            "tooltip": {
                "content": "9<br>CIUDAD DE MEXICO"
            }
        },
        "COAHUILA DE ZARAGOZA": {
            "value": "4",
            "href": "#",
            "tooltip": {
                "content": "4<br>COAHUILA DE ZARAGOZA"
            }
        },
        "COLIMA": {
            "value": "5",
            "href": "#",
            "tooltip": {
                "content": "5<br>COLIMA"
            }
        },
        "DURANGO": {
            "value": "3",
            "href": "#",
            "tooltip": {
                "content": "3<br>DURANGO"
            }
        },
        "GUANAJUATO": {
            "value": "6",
            "href": "#",
            "tooltip": {
                "content": "6<br>GUANAJUATO"
            }
        },
        "GUERRERO": {
            "value": "7",
            "href": "#",
            "tooltip": {
                "content": "7<br>GUERRERO"
            }
        },
        "HIDALGO": {
            "value": "5",
            "href": "#",
            "tooltip": {
                "content": "5<br>HIDALGO"
            }
        },
        "JALISCO": {
            "value": "5",
            "href": "#",
            "tooltip": {
                "content": "5<br>JALISCO"
            }
        },
        "MEXICO": {
            "value": "9",
            "href": "#",
            "tooltip": {
                "content": "9<br>MEXICO"
            }
        },
        "MICHOACAN DE OCAMPO": {
            "value": "5",
            "href": "#",
            "tooltip": {
                "content": "5<br>MICHOACAN DE OCAMPO"
            }
        },
        "MORELOS": {
            "value": "9",
            "href": "#",
            "tooltip": {
                "content": "9<br>MORELOS"
            }
        },
        "NAYARIT": {
            "value": "5",
            "href": "#",
            "tooltip": {
                "content": "5<br>NAYARIT"
            }
        },
        "NUEVO LEON": {
            "value": "4",
            "href": "#",
            "tooltip": {
                "content": "4<br>NUEVO LEON"
            }
        },
        "OAXACA": {
            "value": "7",
            "href": "#",
            "tooltip": {
                "content": "7<br>OAXACA"
            }
        },
        "PUEBLA": {
            "value": "7",
            "href": "#",
            "tooltip": {
                "content": "7<br>PUEBLA"
            }
        },
        "QUERETARO DE ARTEAGA": {
            "value": "6",
            "href": "#",
            "tooltip": {
                "content": "6<br>QUERETARO DE ARTEAGA"
            }
        },
        "QUINTANA ROO": {
            "value": "8",
            "href": "#",
            "tooltip": {
                "content": "8<br>QUINTANA ROO"
            }
        },
        "SAN LUIS POTOSI": {
            "value": "6",
            "href": "#",
            "tooltip": {
                "content": "6<br>SAN LUIS POTOSI"
            }
        },
        "SINALOA": {
            "value": "2",
            "href": "#",
            "tooltip": {
                "content": "2<br>SINALOA"
            }
        },
        "SONORA": {
            "value": "2",
            "href": "#",
            "tooltip": {
                "content": "2<br>SONORA"
            }
        },
        "TABASCO": {
            "value": "8",
            "href": "#",
            "tooltip": {
                "content": "8<br>TABASCO"
            }
        },
        "TAMAULIPAS": {
            "value": "4",
            "href": "#",
            "tooltip": {
                "content": "4<br>TAMAULIPAS"
            }
        },
        "TLAXCALA": {
            "value": "7",
            "href": "#",
            "tooltip": {
                "content": "7<br>TLAXCALA"
            }
        },
        "VERACRUZ": {
            "value": "7",
            "href": "#",
            "tooltip": {
                "content": "7<br>VERACRUZ"
            }
        },
        "YUCATAN": {
            "value": "8",
            "href": "#",
            "tooltip": {
                "content": "8<br>YUCATAN"
            }
        },
        "ZACATECAS": {
            "value": "6",
            "href": "#",
            "tooltip": {
                "content": "6<br>ZACATECAS"
            }
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