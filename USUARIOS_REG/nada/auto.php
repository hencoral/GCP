<html>  
<head>  
<link rel="stylesheet" href="jquery-ui-1.8.2.custom.css" type="text/css" media="all"/>  
  
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>  
<script type="text/javascript" src="jquery-ui-1.8.2.custom.min.js"></script>  
<script type="text/javascript">  
$(function() {   
    var animales = [   
      {label: "Ardilla roja", value: "Sciurus vulgaris"},   
      {label: "Gato", value: "Felis silvestris catus"},   
      {label: "Gorila occidental", value: "Gorilla gorilla"},   
      {label: "Le?n", value: "Panthera leo"},   
      {label: "Oso pardo", value: "Ursus arctos"},   
      {label: "Perro", value: "Canis lupus familiaris"},   
      {label: "Tigre de Bengala", value: "Panthera tigris tigris"}];   
  
    $("#animal").autocomplete({   
      source: animales   
    });   
});   
</script>  
</head>  
  
<body>  
<input type="text" id="animal"/>  
</body>  
</html>  