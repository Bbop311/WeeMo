<?php

namespace App\Service;

class propertyListGenerator
{
    // This function returns an array with all properties, allowing to fetch them sequentially without relying on Ids
    public function getList($propertyRepository) : array
    {
        $properties = $propertyRepository->findAll();
        $properties_list = [];
        foreach($properties as $property){
            $properties_list[] = $property;
        }
        return $properties_list;
    }

    
}