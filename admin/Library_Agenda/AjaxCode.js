
// declare a global  XMLHTTP Request object
var XmlHttpObj;

// create an instance of XMLHTTPRequest Object, varies with browser type, try for IE first then Mozilla
function CreateXmlHttpObj()
{
	// try creating for IE (note: we don't know the user's browser type here, just attempting IE first.)
	try
	{
		XmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			XmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch(oc)
		{
			XmlHttpObj = null;
		}
	}
	// if unable to create using IE specific code then try creating for Mozilla (FireFox) 
	if(!XmlHttpObj && typeof XMLHttpRequest != "undefined") 
	{
		XmlHttpObj = new XMLHttpRequest();
	}
}

// called from onChange or onClick event of the continent dropdown list
function ContinentListOnChange() 
{
    var sdate_hh= document.getElementById("sdate_hh");
    
    // get selected continent from dropdown list
    var selectedsdate_hh = sdate_hh.options[sdate_hh.selectedIndex].value;
    
    // url of page that will send xml data back to client browser
    var requestUrl;
    // use the following line if using asp
    //requestUrl = "xml_data_provider.asp" + "?filter=" + encodeURIComponent(selectedContinent);
    // use the following line if using php
     requestUrl = "xml_data_provider.php" + "?filter=" + encodeURIComponent(selectedsdate_hh);
    
	CreateXmlHttpObj();
	
	// verify XmlHttpObj variable was successfully initialized
	if(XmlHttpObj)
	{
        // assign the StateChangeHandler function ( defined below in this file)
        // to be called when the state of the XmlHttpObj changes
        // receiving data back from the server is one such change
		XmlHttpObj.onreadystatechange = StateChangeHandler;
		
		// define the iteraction with the server -- true for as asynchronous.
		XmlHttpObj.open("GET", requestUrl,  true);
		
		// send request to server, null arg  when using "GET"
		XmlHttpObj.send(null);		
	}
}


// this function called when state of  XmlHttpObj changes
// we're interested in the state that indicates data has been
// received from the server
function StateChangeHandler()
{
	// state ==4 indicates receiving response data from server is completed
	if(XmlHttpObj.readyState == 4)
	{
		// To make sure valid response is received from the server, 200 means response received is OK
		if(XmlHttpObj.status == 200)
		{			
			PopulateCountryList(XmlHttpObj.responseXML.documentElement);
		}
	else
		{
			alert("problem retrieving data from the server, status code: "  + XmlHttpObj.status);
		}
	}
}

// populate the contents of the country dropdown list
function PopulateCountryList(countryNode)
{
    var sdate_ii = document.getElementById("sdate_ii");
	// clear the country list 
	for (var count = sdate_ii.options.length-1; count >-1; count--)
	{
		sdate_ii.options[count] = null;
	}

	var countryNodes = countryNode.getElementsByTagName('sdate_ii_hh');
	var idValue;
	var textValue; 
	var optionItem;
	// populate the dropdown list with data from the xml doc
	for (var count = 0; count < countryNodes.length; count++)
	{
   		textValue = GetInnerText(countryNodes[count]);
		idValue = countryNodes[count].getAttribute("id");
		optionItem = new Option( textValue, idValue,  false, false);
		sdate_ii.options[sdate_ii.length] = optionItem;
	}
}

// returns the node text value 
function GetInnerText (node)
{
	 return (node.textContent || node.innerText || node.text) ;
}









