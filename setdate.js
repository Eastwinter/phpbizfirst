$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'mm/dd/yy',
			maxDate: curdate,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
					from=document.getElementById("from").value;
					to=document.getElementById("to").value;

				if(from!='' && to!='')
				{
					d1=Date.parse(from);
					d2=Date.parse(to);
					msPerDay = 24 * 60 * 60 * 1000;
					dbd = Math.round((d2.valueOf()-d1.valueOf())/ msPerDay) + 1;
					
				
					var selectbox=document.getElementById('period');
					
					selectbox.options.length = 0;
					
					var optn1 = document.createElement("OPTION");
					optn1.text = "Total";
					optn1.value = "t";

					var optn2 = document.createElement("OPTION");
					optn2.text = "Daily";
					optn2.value = "d";

					var optn3 = document.createElement("OPTION");
					optn3.text = "Weekly";
					optn3.value = "w";

					var optn4 = document.createElement("OPTION");
					optn4.text = "Monthly";
					optn4.value = "m";

					var optn5 = document.createElement("OPTION");
					optn5.text = "Yearly";
					optn5.value = "y";

					
					if(dbd>=365)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
						selectbox.options.add(optn4);
						selectbox.options.add(optn5);
					}
					else if(dbd>=30)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
						selectbox.options.add(optn4);
					}
					else if(dbd>=7)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
					}
					else if(dbd>=2)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
					}
					else
					{
						selectbox.options.add(optn1);
					}
						
				}
			}
		});
	});
	
	
$().ready(function() {
	
	
	
	$("#datefrm").validate({
		rules: {
			from: "required",
			to: {
			required: true
			

			}
		},
		messages: {
			from: "<br/>From Date can not be empty.",
			to: {
			required: "<br/>ToDate can not be empty."
					
			}
		}
	});
	


					from=document.getElementById("from").value;
					to=document.getElementById("to").value;

				if(from!='' && to!='')
				{
					d1=Date.parse(from);
					d2=Date.parse(to);
					msPerDay = 24 * 60 * 60 * 1000;
					dbd = Math.round((d2.valueOf()-d1.valueOf())/ msPerDay) + 1;
					
				
					var selectbox=document.getElementById('period');
					
					selectbox.options.length = 0;
					a=0;
					var optn1 = document.createElement("OPTION");
					optn1.text = "Total";
					optn1.value = "t";
					if(selperiod=="t")
						a=0;

					var optn2 = document.createElement("OPTION");
					optn2.text = "Daily";
					optn2.value = "d";
					if(selperiod=="d")
						a=1;

					var optn3 = document.createElement("OPTION");
					optn3.text = "Weekly";
					optn3.value = "w";
					if(selperiod=="w")
						a=2;

					var optn4 = document.createElement("OPTION");
					optn4.text = "Monthly";
					optn4.value = "m";
					if(selperiod=="m")
						a=3;

					var optn5 = document.createElement("OPTION");
					optn5.text = "Yearly";
					optn5.value = "y";
					if(selperiod=="y")
						a=4;

					
					if(dbd>=365)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
						selectbox.options.add(optn4);
						selectbox.options.add(optn5);
					}
					else if(dbd>=30)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
						selectbox.options.add(optn4);
					}
					else if(dbd>=7)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
						selectbox.options.add(optn3);
					}
					else if(dbd>=2)
					{
						selectbox.options.add(optn1);
						selectbox.options.add(optn2);
					}
					else
					{
						selectbox.options.add(optn1);
					}
						selectbox.options.selectedIndex=a;
					
				}
	
});
	
