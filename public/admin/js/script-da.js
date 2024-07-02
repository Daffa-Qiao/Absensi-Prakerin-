const menu = document.querySelector(".wrapper-icon i");
const nav = document.querySelector("nav");

const img = document.querySelector(".user-profile img");
const dropdown = document.querySelector("header.first .dropdownMenu");

const search = document.querySelector(".input-group input"),
  table_rows = document.querySelectorAll("tbody tr"),
  table_headings = document.querySelectorAll("thead th");


table_headings.forEach((head, i) => {
  let sort_asc = true;
  head.onclick = () => {
    table_headings.forEach((head) => head.classList.remove("active"));
    head.classList.add("active");

    document.querySelectorAll("td").forEach((td) => td.classList.remove("active"));
    table_rows.forEach((row) => {
      row.querySelectorAll("td")[i].classList.add("active");
    });

    head.classList.toggle("asc", sort_asc);
    sort_asc = head.classList.contains("asc") ? false : true;

    sortTable(i, sort_asc);
  };
});

function sortTable(column, sort_asc) {
  [...table_rows]
    .sort((a, b) => {
      let first_row = a.querySelectorAll("td")[column].textContent.toLowerCase(),
        second_row = b.querySelectorAll("td")[column].textContent.toLowerCase();

      return sort_asc ? (first_row < second_row ? 1 : -1) : first_row < second_row ? -1 : 1;
    })
    .map((sorted_row) => document.querySelector("tbody").appendChild(sorted_row));
}

jQuery(function () {
  jQuery( '#Fdatepicker' ).datepicker( "getDate" );
  jQuery('#Fdatepicker').datepicker({ 
    dateFormat: 'dd-mm-yy' ,
    dayNamesMin: [ "Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming" ],
    monthNames: [ "Januari", "Februari", "Maret", "April", "May", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
    gotoCurrent: true
  });
  jQuery('#Ldatepicker').datepicker({ 
    dateFormat: 'dd-mm-yy' ,
    dayNamesMin: [ "Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming" ],
    monthNames: [ "Januari", "Februari", "Maret", "April", "May", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
  });
  jQuery('[data-toggle="datepicker"]').datepicker({
    dateFormat: 'dd-mm-yy' ,
    dayNamesMin: [ "Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Ming" ],
    monthNames: [ "Januari", "Februari", "Maret", "April", "May", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
    autoHide: true,
    zIndex: 2048,
 });
  
});
// $( function() {
//   $( "#datepicker" ).datepicker();
// } );


// pdf
const pdf_btn = document.querySelector('#toPDF');
const customers_table = document.querySelector('#dataTable');

function removeClass(element, className) {
  element.classList.remove(className);
  element.classList.add('disabled')
} 
const mati = document.querySelector('th.mati')
removeClass(mati, 'sorting')


const toPDF = function (customers_table) {
  const html_code = `
  <link rel="stylesheet" href="data-absensi.css">
  <style>
  table thead tr th:nth-child(8){
    visibility: hidden;
    border: none;
}
table tbody tr td:nth-child(8){
    visibility: hidden;
    border: none;
}
  </style>
  
  <table class="table" >${customers_table.innerHTML}</table>
  `;
    
    const new_window = window.open();
    new_window.document.write(html_code);
    
    setTimeout(() => {
      new_window.print();
      new_window.close();     
    }, 400);
  }
  
  pdf_btn.onclick = () => {
    toPDF(customers_table);
};

function exportExcel(){
  var table2excel = new Table2Excel();
  table2excel.export(document.querySelectorAll("table.table"));
}


function filtertable(){
  var dropdown = document.getElementById('select')
  var selected = dropdown.value;
  var table = document.getElementById('dataTable')
  var rows = document.getElementsByTagName('tr')
  
  for(var i=1;i<rows.length;i++){
    var row = rows[i];
    var name = row.cells[2].textContent.trim();
    
    if(selected==="all" || name===selected){
      row.style.display="";
    }
    else{
        row.style.display="none";
    }
  }
}