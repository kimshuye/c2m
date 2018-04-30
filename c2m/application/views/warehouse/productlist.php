
<div class="col-md-10 col-sm-9" ng-app="firstapp" ng-controller="Index">
	
<div class="panel panel-default">
	<div class="panel-body">



<div style="float: right;">
	<button class="btn btn-info" ng-click="Modalexcel()"> 
	<?=$lang_importproductexcel?></button>
</div>


<form class="form-inline">
<div class="form-group">
<button class="btn btn-primary" ng-click="Modaladd()"><?=$lang_addproduct?></button>
</div>
<div class="form-group">
<input type="text" ng-model="searchtext" class="form-control" placeholder="<?=$lang_search?>" style="width: 300px;">
</div>
<div class="form-group">
<button type="submit" ng-click="getlist(searchtext,'1')" class="btn btn-success" placeholder="" title="<?=$lang_search?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</div>
<div class="form-group">
<button type="submit" ng-click="getlist('','1')" class="btn btn-default" placeholder="" title="<?=$lang_refresh?>"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
</div>

</form>


<br />


<div style="float: right;">
	<input type="checkbox" ng-model="showdeletcbut"> <?=$lang_showdel?>
</div>
<table id="headerTable" class="table table-hover table-bordered">
	<thead>
		<tr style="background-color: #eee;">
			<th style="width: 50px;"><?=$lang_rank?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_barcode?></th>
			<th style="text-align: center;width: 50px;">Barcode</th>
			<th style="text-align: center;width: 150px;"><?=$lang_picproduct?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_productname?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_category?></th>
			<th style="text-align: center;width: 100px;">Supplier</th>
			<th style="text-align: center;width: 100px;"><?=$lang_costperunit?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_priceperunit?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_score?></th>
			<th style="text-align: center;width: 100px;"><?=$lang_wherestore?></th>
			<th style="width: 80px;"><?=$lang_manage?></th>
		</tr>
	</thead>
	<tbody>
	



		<tr ng-repeat="x in list">
		<td ng-if="selectpage=='1'" class="text-center">{{($index+1)}}</td>
			<td ng-if="selectpage!='1'" class="text-center">{{($index+1)+(perpage*(selectpage-1))}}</td>
		

			
<td  align="center">
{{x.product_code}}
</td>
<td align="center">
<a href="<?php echo $base_url; ?>/warehouse/barcode?sheet=1&product_code={{x.product_code}}&product_name={{x.product_name}}&product_price={{x.product_price | number:2}}" class="btn btn-xs btn-default" target="_blank"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Barcode</a></td>

<td align="center">
<img ng-if="x.product_image!=''" ng-src="<?php echo $base_url;?>/{{x.product_image}}" width="70px" height="70px;">

			</td>

			<td>{{x.product_name}}

			</td>
			
			<td>{{x.product_category_name}}</td>


<td>
{{x.supplier_name}}
</td>

			<td align="right">{{x.product_pricebase | number:2}}</td>
			<td align="right">{{x.product_price | number:2}}</td>
			
			<td align="right">{{x.product_score | number}}</td>

			<td align="right">{{x.product_location}}</td>

			<td>

				<button class="btn btn-xs btn-warning" ng-click="Editinputproduct(x)"><?=$lang_edit?></button>
				<button ng-show="showdeletcbut" class="btn btn-xs btn-danger" ng-click="Deleteproduct(x.product_id)"><?=$lang_delete?></button>
			</td>

		

		</tr>
	</tbody>
</table>







<form class="form-inline">
<div class="form-group">
<?=$lang_show?>
<select class="form-control" name="" id="" ng-model="perpage" ng-change="getlist(searchtext,'1',perpage)">
	<option value="10">10</option>
	<option value="20">20</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
	<option value="300">300</option>
</select>

<?=$lang_page?>
<select name="" id="" class="form-control" ng-model="selectthispage"  ng-change="getlist(searchtext,selectthispage,perpage)">
	<option  ng-repeat="i in pagealladd" value="{{i.a}}">{{i.a}}</option>
</select>
</div>


</form>




<hr />
<button id="btnExport" class="btn btn-default" onclick="fnExcelReport();"> <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
<?=$lang_downloadexcel?> </button>





<div class="modal fade" id="Openadd">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?=$lang_addproduct?></h4>
			</div>
			<div class="modal-body">
				<form id="uploadImg"  enctype="multipart/form-data" method="POST">

<?=$lang_barcode?>
<p></p>
<input type="text" id="id1" placeholder="รหัสประเทศ" class="" value="885" maxlength="3" style="width: 50px;" onkeyup="myFunction()">
<input type="text" id="id2" placeholder="รหัสผู้ผลิต" class="" value="0000" maxlength="4" style="width: 65px;" onkeyup="myFunction()">
<input type="text" id="id3" placeholder="รหัสสินค้า" class="" value="00000" maxlength="5" style="width: 80px;" onkeyup="myFunction()">
<input type="text" id="id4" placeholder="sum" class="" value="0" maxlength="1" style="width: 35px;" onkeyup="myFunction()" disabled>
<script>
function myFunction() {
    var x = document.getElementById("id1").value +
    		document.getElementById("id2").value +
    		document.getElementById("id3").value  ;
    var even = (subInt(x, 2) + subInt(x, 4) + subInt(x, 6) + subInt(x, 8) + subInt(x, 10) + subInt(x, 12) ) * 3;
    var odd = (subInt(x, 1) + subInt(x, 3) + subInt(x, 5) + subInt(x, 7) + subInt(x, 9) + subInt(x, 11) );
    var result = 10 - ( ( even + odd ) % 10);
    document.getElementById("id4").value = result.toString();
    document.getElementsByName("product_code")[0].value = x + result.toString();
}
function subInt(txt,pos){
	return parseInt(txt.substring(pos-1, pos));
}
</script>
<p></p>
<input type="text" name="product_code"  placeholder="รหัสสินค้า" class="form-control"  >
<p></p>
<?=$lang_picproduct?>
<input type="file" name="product_image" accept="image/*" class="form-control" value="">
<p></p>
<?=$lang_productname?>
<input type="text" name="product_name"  placeholder="ชื่อสินค้า" class="form-control">
<p></p>
<?=$lang_category?>
<select class="form-control" name="product_category_id" >
<option value="0"><?=$lang_selectcategory?></option>
					<option ng-repeat="y in categorylist" value="{{y.product_category_id}}">
						{{y.product_category_name}}
					</option>
				</select>
<p></p>

Supplier
<select class="form-control" name="supplier_id" >
				<option value="0"><?=$lang_select?></option>
					<option ng-repeat="x in supplierlist" value="{{x.supplier_id}}">
						{{x.supplier_name}}
					</option>
				</select>



				<p></p>
<?=$lang_cost?>
	<input type="text" name="product_pricebase"  placeholder="<?=$lang_cost?>" class="form-control text-right">
	<p></p>
	<?=$lang_saleprice?>
	<input type="text" name="product_price"  placeholder="<?=$lang_saleprice?>" class="form-control text-right">

<p></p>
	<?=$lang_score?>
	<input type="text" name="product_score"  placeholder="<?=$lang_score?>" class="form-control text-right">

	<p></p>
	<?=$lang_wherestore?>
	<input type="text" name="product_location"  placeholder="<?=$lang_wherestore?>" class="form-control text-right">

	<p></p>



<button class="btn btn-success" type="submit"><?=$lang_save?></button>
</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>





<div class="modal fade" id="Openedit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?=$lang_edit?></h4>
			</div>
			<div class="modal-body">
				<form id="Updatedata"  enctype="multipart/form-data" method="POST">

<input type="hidden" name="product_id" id="product_id">
<?=$lang_barcode?>
<input type="text" name="product_code" id="product_code" placeholder="<?=$lang_barcode?>" class="form-control">
<p></p>
<input type="hidden" name="product_image2" id="product_image2">
<center>
<img ng-if="product_image!=''" ng-src="<?php echo $base_url;?>/{{product_image}}" width="70px" height="70px;">
</center>
<?=$lang_picproduct?>
<input type="file" name="product_image" accept="image/*" class="form-control" value="">
<p></p>
<?=$lang_productname?>
<input type="text" name="product_name" id="product_name" placeholder="<?=$lang_productname?>" class="form-control">
<p></p>
<?=$lang_category?>
<select class="form-control" name="product_category_id" id="product_category_id">

					<option ng-repeat="y in categorylist" value="{{y.product_category_id}}">
						{{y.product_category_name}}
					</option>
				</select>
<p></p>

Supplier
<select class="form-control" name="supplier_id" id="supplier_id">
				<option value="0"><?=$lang_select?></option>
					<option ng-repeat="x in supplierlist" value="{{x.supplier_id}}">
						{{x.supplier_name}}
					</option>
				</select>



				<p></p>
<?=$lang_cost?>
	<input type="text" name="product_pricebase" id="product_pricebase" placeholder="<?=$lang_cost?>" class="form-control text-right">
	<p></p>
	<?=$lang_saleprice?>
	<input type="text" name="product_price" id="product_price" placeholder="<?=$lang_saleprice?>" class="form-control text-right">

<p></p>
	<?=$lang_score?>
	<input type="text" name="product_score" id="product_score" placeholder="<?=$lang_score?>" class="form-control text-right">

	<p></p>
	<?=$lang_wherestore?>
	<input type="text" name="product_location" id="product_location" placeholder="<?=$lang_wherestore?>" class="form-control text-right">

	<p></p>



<button class="btn btn-success" type="submit"><?=$lang_save?></button>
</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="Modalexcel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?=$lang_productlistfromexcel?></h4>
			</div>
			<div class="modal-body text-center">

<form enctype="multipart/form-data" id="formexcel">
<input type="file" accept=".csv" id="excel" name="excel" class="btn btn-default">   
<br />
<button class="btn btn-success" id="submitexcel" type="submit"><?=$lang_upload?></button>
</form>

<hr />
<font color="red"><?=$lang_csvexsample?></font>
<br />
<img src="<?php echo $base_url;?>/pic/imcsv.png">
			</div>
			
		</div>
	</div>
</div>







	</div>


	</div>

	</div>


	<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope,$http,$location) {

$scope.product_category_id = '0';
$scope.supplier_id = '0';
$scope.productlist = [];

$scope.Modalexcel = function(){
$('#Modalexcel').modal('show');
};

$scope.Modaladd = function(){
$('#Openadd').modal('show');
};



$scope.getcategory = function(){
   
$http.get('Productcategory/get')
       .then(function(response){
          $scope.categorylist = response.data.list; 
                 
        });
   };
$scope.getcategory();


$scope.getsupplier = function(){
   
$http.get('Supplier/getlist')
       .then(function(response){
          $scope.supplierlist = response.data.list; 
                 
        });
   };
$scope.getsupplier();



$scope.perpage = '10';
$scope.getlist = function(searchtext,page,perpage){
    if(!searchtext){
   	searchtext = '';
   }


    if(!page){
   var	page = '1';
   }

 if(!perpage){
   var	perpage = '10';
   }

 $http.post("Productlist/get",{
searchtext:searchtext,
page: page,
perpage: perpage
}).success(function(data){
          $scope.list = data.list; 
                 $scope.pageall = data.pageall;
$scope.numall = data.numall;

$scope.pagealladd = [];
           for(i=1;i<=$scope.pageall;i++){
$scope.pagealladd.push({a:i});
}

$scope.selectpage = page;
$scope.selectthispage = page;
        });
   };
$scope.getlist('','1');





$scope.Saveproduct = function(product_code,product_name,product_price,product_pricebase,product_category_id,supplier_id,product_score){
$http.post("Productlist/Add",{
	product_code: product_code,
	product_name: product_name,
	product_price: product_price,
	product_pricebase: product_pricebase,
	product_category_id: product_category_id,
	product_score: product_score,
	supplier_id: supplier_id
	}).success(function(data){
toastr.success('<?=$lang_success?>');
$scope.product_code = '';
$scope.product_name = '';
$scope.product_pricebase = '';
$scope.product_price = '';
$scope.product_score = '';
$scope.getlist();
        });	
};



$(document).ready(function (e) {
    $('#uploadImg').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: 'Productlist/Add',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){ 
$( "#uploadImg" )[0].reset();
$('#Openadd').modal('hide');
$scope.getlist();


            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

 
});



$scope.Editinputproduct = function(x){
	$('#Openedit').modal('show');
$("#product_id").val(x.product_id);
$("#product_code").val(x.product_code);
$("#product_name").val(x.product_name);
$("#product_image2").val(x.product_image);
$("#product_price").val(x.product_price);
$("#product_pricebase").val(x.product_pricebase);
$("#product_category_id").val(x.product_category_id);
$("#product_score").val(x.product_score);
$("#product_location").val(x.product_location);
$("#supplier_id").val(x.supplier_id);

$scope.product_image = x.product_image;

};

$scope.Cancelproduct = function(product_id){
$scope.product_id = '';
$scope.getlist();
};

/*$scope.Editsaveproduct = function(product_id,product_code,product_name,product_price,product_pricebase,product_category_id,supplier_id){
$http.post("Productlist/Update",{
	product_id: product_id,
	product_code: product_code,
	product_name: product_name,
	product_pricebase: product_pricebase,
	product_price: product_price,
	product_category_id: product_category_id,
	supplier_id: supplier_id
	}).success(function(data){
toastr.success('บันทึกเรียบร้อย');
$scope.product_id = '';
$scope.getlist();

        });	
};*/



$(document).ready(function (e) {
    $('#Updatedata').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: 'Productlist/Update',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){ 
$( "#Updatedata" )[0].reset();
$scope.getlist('',$scope.selectthispage,$scope.perpage);
$('#Openedit').modal('hide');
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

});





$scope.Deleteproduct = function(product_id){
$http.post("Productlist/Delete",{
	product_id: product_id
	}).success(function(data){
toastr.success('<?=$lang_success?>');
$scope.getlist();
        });	
};

   


   
	
    $("form#formexcel").submit(function () {
var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "Productlist/uploadexcel",
            data:formData,
            processData: false,
   		 	contentType: false,
            success: function () {
               toastr.success('<?=$lang_success?>');
               $('#Modalexcel').modal('hide');
               $scope.getlist('','1');
            }
        });
    });






});
	</script>
