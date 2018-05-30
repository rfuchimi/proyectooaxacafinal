<div id="resultado"></div>
<?php
//$this->load->view('mapa_mex/index');
$this->load->view('chart');
?>
<script type="text/javascript">
    function mostrarMapa() 
    {
       
       $('#map').show(3000);
       $('.map').show("slow");
    }

    function ocultarMapa()
    {
       
       $('#map').hide(3000);
       $('.map').hide("fast"); 
    }
</script>