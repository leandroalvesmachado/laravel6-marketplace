<?php

// filtrando items para a loja storeId
function filterItemsByStoreId($items, $storeId) 
{
    return array_filter($items, function($line) use ($storeId) {
        return $line['store_id'] == $storeId;
    });
}

function formatPriceToDatabase($price)
{
    // tudo que for . fica vazio
    // tudo que for virgula fica ponto
    return str_replace(['.', ','], ['', '.'], $price);
}