$(document).ready(function() {
  $('#dataTable').DataTable({
    scrollX: true, // Enable horizontal scrolling
    scrollY: false, // Enable vertical scrolling
    scrollCollapse: true, // Collapse table height when fewer rows
    paging: true, // Enable pagination
    responsive: true, // Make the table responsive
    language: {
      search: "Search records:", // Change search input label
      lengthMenu: "Show _MENU_ entries per page", // Change length menu label
    }
  });
});