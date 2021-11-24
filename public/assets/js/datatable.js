$(function (e) {
    $("#users_table").DataTable();
    $("#category_table").DataTable();
    $("#browser_table").DataTable();
    $("#layout_table").DataTable();
    $("#compatible_table").DataTable();
    $("#review_category_table").DataTable();
    $("#social_table").DataTable();
    $("#user_reports_table").DataTable();
    $("#apikey_table").DataTable();
    $("#orders_table").DataTable({
        order: [[3, "desc"]],
    });
});
