$( document ).ready( function()
{
	var blogovi_lista = $(".panel-body");
	
	
	
	for (var i=0; i<blogovi_lista.length; ++i)
	{
		blogovi_lista.eq(i).mouseover(function()
		{
			$(this).css("background-color", "powderblue");
			//$(this).css("background-color", "whitesmoke");
			
		}
	);
		blogovi_lista.eq(i).mouseout(function()
		{
			$(this).css("background-color", "white");
		}
	);
	
	}
	
	
	var postovi_naslov = $(".post-name");
	
	var datumi = $(".datum");
	
	datumi.hide();
	//datumi.css("display", "none");
	datumi.css("font-style", "italic");
	datumi.css("color", "grey");
	
	
	for(var i = 0; i<postovi_naslov.length; ++i)
	{
		postovi_naslov.eq(i).mouseover(function()
		{
			datumi.show();
		}
		);
		
		postovi_naslov.eq(i).mouseout(function()
		{
			datumi.hide();
		}
		);
	
		
	}
}
);