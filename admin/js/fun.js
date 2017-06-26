
function CheckLength( o, n, min, max ) {
	if ( o.val().length > max || o.val().length < min ) {
		alert( "Length of " + n + " must be between " + min + " and " + max + "." );
		return false;
	}
	return true;
}
 
function CheckRegexp( o, regexp, n ) {
	if ( !( regexp.test( o ) ) ) {
		alert( n );
		return false;
	}
	return true;
}

function CheckSelect( selector ) {
	$(selector).each(function(){
		// console.debug ($(this).val());
		if ($(this).val() == '') {
			alert('有欄位尚未選擇！');
			$(this).focus();
			// return false;
			valid = false;
		}
	});
}

function CheckDate ( date ) {
	pattern  = /^((19|20|21)[0-9]{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]))$/;
	return CheckRegexp(date, pattern, 'Date format error! [ex: 2015-11-27]')
}

function CheckStartEndDate (start_date, end_date, start_time, end_ttime) {
	ret = true;
	ret = ret & CheckDate(start_date) & CheckDate(end_date);
	if (ret == false) {
		return ret;
	}
	ret = ret & ( ((start_date < end_date) || (start_date == end_date && start_time <= end_ttime)) ? true : false );
	if (ret == false) {
		alert("[開始時間]與[結束時間]資料有誤！");
	}
	return ret;
}

// Sorting table based on user clicked which th
function SortTable(a,b){
	var A, B;

	if (sortInt) {
		A = parseInt( $(a).children('td').eq(sortIndex).text() );
		B = parseInt( $(b).children('td').eq(sortIndex).text() );
	} else {
		A = $(a).children('td').eq(sortIndex).text();
		B = $(b).children('td').eq(sortIndex).text();
	}

	if (ascending) {
		if (A > B) return 1;
		if( A < B) return -1;
	} else {
		if (A > B) return -1;
		if( A < B) return 1;
	}
	return 0;
}	

// Click table header to ascending/descending sorting 
function ThToggle(table, tdIndex, intType, selector) {
	$(selector).on('click', function(){
		sortIndex	= tdIndex;
		sortInt		= intType;
        var rows = $(table + " tbody tr").get();
        rows.sort(SortTable);
		
        $.each(rows, function(index, row){
			$(table).children("tbody").append(row);
        });
		
		// Change sorting type
		ascending = !ascending;
    });
}

function CreatePagination() {
	// var totalPage = [<?php for ($i=0; $i<5; $i++) {echo ceil($num_rows[$i]/$page_rows).",";}?>];
	var st, end, str='';

	if (page<=5) {
		st	= 1;
		end = (totalPage > 10) ? 10 : totalPage;
	} else {
		st = page-5;
		end = ((page+5) < totalPage) ? (page+5) : totalPage;
	}

	if(page>1){
		// //第一頁
		str += "<a href=\"#\" onclick=\"Page(1);\">&lt;&lt;</a>";			
		// //上一頁
		str += "<a href=\"#\" onclick=\"Page(" + (page-1) + ");\">&lt;</a>";	

	}
	
	for(i=st; i<=end; i++){
		clss="";
		if(i==page){
			str += "<a class=\"on\">" + i + "</a>";
		} else {
			str += "<a "+clss+" href=\"#\" onclick=\"Page(" + i + ");\">" + i + "</a>";
		}
	}
	
	if(page<totalPage){	
		//下一頁
		str +=  "<a href=\"#\" onclick=\"Page(" + (page+1) + ");\">&gt;</a>";
		str +=  "<a href=\"#\" onclick=\"Page(" + totalPage + ");\">&gt;&gt;</a>";
	}
	
	$('.pagination')[0].innerHTML = str;
}
