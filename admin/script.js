	
	function mk_height()
	{
		if (window.innerHeight) {
			var h = window.innerHeight;
		}
		else if (document.body && document.body.clientHeight) {
			var h = document.body.clientHeight;
		}
		var y = (h-114);
		
		if(y > document.getElementById('mk_height').offsetHeight)
			document.getElementById('mk_height').style.height=y+'px';
	}
	
	function all_select(row)
	{
		if(document.getElementById('allcheck').checked==true)
		{
			for(i=0; i<row; i++ )
			{
				var check='check'+i;
				document.getElementById(check).checked=true;
			}
			
			return true;
		}
		
		else if(document.getElementById('allcheck').checked==false)
		{
			for(i=0; i<row; i++ )
			{
				var uncheck='check'+i;
				document.getElementById(uncheck).checked=false;
			}
			
			return true;
		}
	}

	function unchecked()
	{	
		document.getElementById('allcheck').checked=false;
	}
	
	function delete_confirm()
	{	
		return confirm('Are you sure you want to Delete?');
	}
	
	function confirm_ban()
	{	
		return confirm('Are you sure you want to Ban this member?');
	}
	
	function inactive_shoe()
	{	
		return confirm('Are you sure you want to inactive this Shoe?');
	}
	
	
	function back_page()
	{
		window.location.href = "static_pagesmanage.php";
	}
	
	function add_new_page()
	{
		window.location.href = script_url+"admin/page/add_static_page";
	}	
	
	function back_contacts()
	{
		window.location.href = script_url+"admin/msgs/site_contacts";
	}
	
	function add_advertiser()
	{
		window.location.href = script_url+"admin/advertiser/add_advertiser";
	}	
	
	function add_banner()
	{
		window.location.href = script_url+"admin/banner/add_banner";
	}
	
	function add_newsletter()
	{
		window.location.href = script_url+"admin/newsletter/add_newsletter";
	}
	
	function add_shoe()
	{
		window.location.href = script_url+"admin/member/add_shoe";
	}
	
	function banner_type(type)
	{
		if(type == 'image' || type == 'flash')
		{
			document.getElementById('local').style.display='block';
			document.getElementById('remote').style.display='none'; 
		}
		
		if(type == 'remote')
		{
			document.getElementById('local').style.display='none';
			document.getElementById('remote').style.display='block'; 
		}
	}
	
	function banner_parameters(val)
	{
		if(val == 0)
			document.getElementById('parameters').style.display='block';
		else
			document.getElementById('parameters').style.display='none';
	}