$(document).ready(function(){
    

   $('#addRequest').click(addRequest);
   
	function addRequest()
	{
		
		requestName = $('#requestName').val();
	    requestDescr = $('#requestDescr').val();
		requestEmail = $('#requestEmail').val();
		requestPhone = $('#requestPhone').val();
			   
		if ((requestName == "") || (requestDescr == "") || (requestEmail == "") || (requestPhone == ""))
		{
			   
			alert("Вниание: Всички полета са задължителни!");
			return false;
		}
		else
		{
		  
		  var detailID = $('#detailID').val();
		  location = "makerequest.php?id=" + detailID + 
			"&requestName=" + requestName + 
			"&requestDescr=" + requestDescr + 
			"&requestEmail=" + requestEmail + 
			"&requestPhone=" + requestPhone;
			
			return false;
		}
		
	}
	
	
	function EditPost(postID)
	{	
	  location = "admin.php?editedID=" + postID;
	}
	
	
	$("a[href=#canEditPost]").live(
	"click",
		function (e) {			  		

		   var postID = $(this).data("identity");		  		  
		   EditPost(postID)			   
		}
	);
	
	function deletePost(postID)
	{
	
		location = "delete.php?id=" + postID;		
	}
	
	
	$("a[href=#canDeletePost]").live(
	"click",
		function (e) {			  		

		   var postID = $(this).data("identity");		  
		   var response = confirm("Сигурен ли сте, че искате да изтриете този артикул?");
		   if (response)			  
			 deletePost(postID)	
		   else 
		     return false;
		   
		}
	);

	
	
});

