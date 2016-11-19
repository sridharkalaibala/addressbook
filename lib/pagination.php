<?php

    function getStart($limit) {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        if ($page)
            return ($page - 1) * $limit;            //first item to display on this page
        else
            return 0;
    }

    function getPagination($limit, $total_records, $page_name='index.php?')
    {
        $adjacents = 3;
        //if no page var is given, set start to 0
        /* Get data. */
        $page = isset($_GET['page']) ? $_GET['page'] : 0;

        if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_records / $limit);        //lastpage is = total pages / items per page, rounded up.

        $lpm1 = $lastpage - 1;                        //last page minus 1

        $pagination = '';
        if ($lastpage > 1) {
            $pagination .= '<div >';
            //previous button
            if ($page > 1)
                $pagination .= '<a href="'.$page_name.'page='.$prev.'" class=my_pagination >Previous</a>';
            else
                $pagination .= '<span class=my_pagination>Previous</span>';
            //pages
            if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= '<span class=my_pagination>'.$counter.'</span>';
                    else
                        $pagination .= '<a href="'.$page_name.'page='.$counter.'" class=my_pagination>'.$counter.'</a>';
                }
            } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= '<span class=my_pagination>$counter</span>';
                        else
                            $pagination .= '<a href="'.$page_name.'page='.$counter.'" class=my_pagination>'.$counter.'</a>';
                    }
                    $pagination .= '...';
                    $pagination .= '<a href="'.$page_name.'page='.$lpm1.'" class=my_pagination>'.$lpm1.'</a>';
                    $pagination .= '<a href="'.$page_name.'page='.$lastpage.'" class=my_pagination>'.$lastpage.'</a>';
                } //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= '<a href="'.$page_name.'page=1" class=my_pagination>1</a>';
                    $pagination .= '<a href="'.$page_name.'page=2" class=my_pagination>2</a>';
                    $pagination .= '...';
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= '<span  class=my_pagination>'.$counter.'</span>';
                        else
                            $pagination .= '<a href="'.$page_name.'page='.$counter.'" class=my_pagination>'.$counter.'</a>';
                    }
                    $pagination .= '...';
                    $pagination .= '<a href="'.$page_name.'page='.$lpm1.'" class=my_pagination>'.$lpm1.'</a>';
                    $pagination .= '<a href="'.$page_name.'page='.$lastpage.'" class=my_pagination>'.$lastpage.'</a>';
                } //close to end; only hide early pages
                else {
                    $pagination .= '<a href="'.$page_name.'page=1" class=my_pagination>1</a>';
                    $pagination .= '<a href="'.$page_name.'page=2" class=my_pagination>2</a>';
                    $pagination .= '...';
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= '<span class=my_pagination >'.$counter.'</span>';
                        else
                            $pagination .= '<a href="'.$page_name.'page='.$counter.'" class=my_pagination>'.$counter.'</a>';
                    }
                }
            }
            //next button
            if ($page < $counter - 1)
                $pagination .= '<a href="'.$page_name.'page='.$next.'" class=my_pagination>Next</a>';
            else
                $pagination .= '<span class= my_pagination >Next</span>';
            $pagination .= "</div>\n";
        }

        return $pagination;
    }


?>