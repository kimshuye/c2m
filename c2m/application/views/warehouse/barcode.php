<!DOCTYPE html>
<html>
<head>



<style>
    body {
        width: 8.5in;
        margin: 0in .1875in;
        }
    .labelx{
        /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
        width: 2.025in;  /* plus .6 inches from padding */
        /*height: .875in;  plus .125 inches from padding */
        padding: .025in .4in 0;
        margin-right: .125in; /* the gutter */
        padding-left: 0px;

        float: left;

        text-align: center;
        overflow: hidden;

        outline: 1px dotted; /* outline doesn't occupy space like border does */
        }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
        }

        @media print {
    body * {
        visibility: hidden;
    }
    #section-to-print, #section-to-print * {
        visibility: visible;
   
    }
    #section-to-print {
        position: absolute;
        left: 0;
        top: 0;
    }
    svg {
      margin: 20px;
    }
    </style>

<script>

function setQuantity(field){
    var x1,x2,x3,x4,x5,x6;
    var num = field.value;

    console.log("num : "+ num );

    for (var i = 0; i < num; i++) {

        // main div on create

        x1 = document.createElement("DIV");   
        x1.setAttribute("class", "labelx");
        //x1.setAttribute("id", "div2");
        
        document.getElementById("section-to-print").appendChild(x1);

        // ============

        x2 = document.createElement("FONT");   
        x2.setAttribute("size", "2");
        x2.innerHTML = "<?php if(isset($_GET['product_name'])) echo $_GET['product_name']; ?>";

        x1.appendChild(x2);

        x3 = document.createElement("BR");   
        x1.appendChild(x3);

        x4 = document.createElement("svg"); 
        x4.setAttribute("id", "ean-13-<?php if(isset($_GET['product_code'])){ echo $_GET['product_code']; } ?>");  
        x1.appendChild(x4);        

        x3 = document.createElement("BR");   
        x1.appendChild(x3);

        x6 = document.createElement("CENTER");   
        x1.appendChild(x6);

        x5 = document.createElement("SPAN");
        x5.setAttribute("style", "font-weight:bold;font-size:25px;");  
        x5.innerHTML = "<?php if(isset($_GET['product_price'])){ echo $_GET['product_price']; } ?>";
        x6.appendChild(x5);

        

    }
}

</script>
	
    <title>Barcode <?php if(isset($_GET['product_name'])){ echo $_GET['product_name']; } ?> </title>
</head>

<body>
<button class="btn btn-success"  onclick="window.print()">Print</button>
<!--input type="number" value="15" onkeyup="setQuantity(this)" /-->

<form action="barcode" method="get">
<input type="number" name="sheet" value="<?php echo $_GET['sheet']; ?>"/>
<input type="hidden" name="product_code" value="<?php echo $_GET['product_code']; ?>">
<input type="hidden" name="product_name" value="<?php echo $_GET['product_name']; ?>">
<input type="hidden" name="product_price" value="<?php echo $_GET['product_price']; ?>">
<input type="submit">
</form>

<hr/>

<div id="section-to-print">

<!--

<?php

for($i=1;$i<=15;$i++){ ?>

    <div class="labelx">
        <font size="2">
            <?php if(isset($_GET['product_name'])) { echo $_GET['product_name']; }  ?>
        </font><br />
            <img 
                src="<?php echo $base_url; ?>/warehouse/barcode/png?barcode=
                <?php if(isset($_GET['product_code'])) { echo $_GET['product_code']; } ?>
                " >
        <br />
        <center>
            <span style="font-weight:bold;font-size:25px;"> 

        <?php if(isset($_GET['product_price'])){ echo $_GET['product_price']; } ?>
            </span>
        </center>
    </div>

<?php

}

?>

-->

<?php

$sheet=(isset($_GET['sheet'])) ? $_GET['sheet']:15;

for($i=1;$i<=$sheet;$i++){ ?>

    <div class="labelx" style="padding-right: 60px;" >
        <font size="3">
            <?php if(isset($_GET['product_name'])) echo $_GET['product_name']; ?>            
        </font><br>
        <svg id="ean-13-<?php if(isset($_GET['product_code'])){ echo $_GET['product_code']; } ?>"  style="height:120px"></svg>
        
        <br>
            <center>
                <span style="font-weight:bold;font-size:25px;">
                    <?php if(isset($_GET['product_price'])){ echo $_GET['product_price']; } ?>
                </span>
            </center>
    </div>

<?php

}

?>

<script src='../js/JsBarcode.all.min.js'></script>

<script>

<?php

for($i=1;$i<=27;$i++){ ?>

    JsBarcode(
        "#ean-13-<?php if(isset($_GET['product_code'])){ echo $_GET['product_code']; } ?>"
        , "<?php if(isset($_GET['product_code'])){ echo $_GET['product_code']; } ?>"
        , {format: "ean13"}
    );

<?php
}
?>



</script>



</div>

</body>
</html>


