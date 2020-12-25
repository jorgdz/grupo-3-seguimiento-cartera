const select = document.getElementById('depart')

function getdepartamentos(str)
{ 
	var xmlhttp;

	if (window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			getData(JSON.parse(xmlhttp.responseText))
		}
	}

	xmlhttp.open("GET","/api/departamentos/"+str, true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}

function getData(data){
	select.innerHTML=''
	const f = document.createDocumentFragment()
		
	data.forEach(d => {
		
		const option=document.createElement('option')
		option.textContent=d.departamento.nombre_departamento
		option.value = d.id		
		f.appendChild(option)

	})
	
	select.appendChild(f)	
}