
var catChartResult={
		p1:0,
		p2:0,
		p3:0,
		p4:0
		
};
var barChartResult=null;
var keys=new Array();
var chartVal = new Array();
var chartBase = new Array();

function getOrderReport(data) {
	
				try {
					//alert(JSON.stringify(data[0]["ordr"]));
					//Set Result For Pie Chart 
					keys= new Array();
					chartVal = new Array();
					chartBase = new Array();
										
					for (var i = 0; i < 10; i++) {
						chartVal.push(data[i]["ordr"]);
						chartBase.push(data[i]["mdate"]);
					}
								
					var max = Math.max.apply(Math,chartVal); 
					demo.initChartist(chartBase,chartVal,max);
				} catch (e) {
					console.log("Exception::-"+e.toString());
				}
			
}
function getTopOrders(data){
	var ordr = {};
	var array=[];
	for (var i = 0; i < data.length; i++) {
		if(data[i]['ordr_p'].length > 4)
		{	
			var ordr_p = JSON.parse(data[i]['ordr_p']);
			
			for (var j = 0; j < ordr_p.length; j++) {
			//alert(ordr[ordr_p[j]["item"]]);
				if(ordr[ordr_p[j]["item"]])
					ordr[ordr_p[j]["item"]] += parseFloat(ordr_p[j]["qty"]);
				else
					ordr[ordr_p[j]["item"]] = parseFloat(ordr_p[j]["qty"]);
			}
		}
	}
	for(a in ordr){
		array.push([a,ordr[a]])
	}
	array.sort(function(a,b){return a[1] - b[1]});
	array.reverse();
	var o=[];
	o[0]=array[0];
	o[1]=array[1];
	o[2]=array[2];
	o[3]=array[3];
	
	
	catChartResult.p1=o[0][1];
	catChartResult.p2=o[1][1];
	catChartResult.p3=o[2][1];
	catChartResult.p4=o[3][1];
										
	demo.initChartist1(catChartResult);
	document.getElementById("p1").innerHTML = o[0][0];
	document.getElementById("p2").innerHTML = o[1][0];
	document.getElementById("p3").innerHTML = o[2][0];
	document.getElementById("p4").innerHTML = o[3][0];
	
	
}


