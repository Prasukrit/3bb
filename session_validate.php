<?php
    $sql_sale_match = "SELECT * FROM rx_user WHERE user_email='" .$_SESSION['ro10app']. "'";
    $query_sale_match = mysqli_query($conn_sale, $sql_sale_match);
    $row_sale_match = mysqli_fetch_assoc($query_sale_match);
    $row_sale_match_id = $row_sale_match["user_code"];
    $row_sale_match_name = $row_sale_match["user_name"];
    $row_sale_match_email = $row_sale_match["user_email"];
?>