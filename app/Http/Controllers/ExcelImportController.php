<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\test;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;


class ExcelImportController extends Controller
{
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx|max:10240', // Adjust the file type and size as needed
        ]);


        $file = $request->file('file');


        $jsonData = (new FastExcel)->import($file, function ($line) {

            preg_match('/Brand\s*:\s*(.*?)(?:,|$)/', $line['Item_Name'], $brandMatch);
            preg_match('/Model\s*:\s*(.*?)(?:,|$)/', $line['Item_Name'], $modelMatch);
            preg_match('/Size\s*:\s*(.*?)(?:,|$)/', $line['Item_Name'], $sizeMatch);

            $brand = isset($brandMatch[0]) ? trim($brandMatch[0]) : null;
            $model = isset($modelMatch[0]) ? trim($modelMatch[0]) : null;
            $size = isset($sizeMatch[0]) ? trim($sizeMatch[0]) : null;



            return [

                'item_id' => $line['Item_ID'], // Assuming 'item_id' is a column in your Excel file
                'Brand' => isset($brandMatch[1]) ? trim($brandMatch[1]) : null,
                'Model' => isset($modelMatch[1]) ? trim($modelMatch[1]) : null,
                'Size' => isset($sizeMatch[1]) ? trim($sizeMatch[1]) : null,
                'Item' => $this->extractItemName($line['Item_Name'], $brand, $model, $size),
            ];
        });


        foreach ($jsonData as $data) {
            Equipment::updateOrInsert(
                ['item_id'  => $data['item_id']], // Match based on 'item_id'
                [
                    'Brand' => $data['Brand'],
                    'Model' => $data['Model'],
                    'Size' => $data['Size'],
                    'Item_name' => $data['Item'],
                ]
            );
        }


        return redirect()->back()->with('success', 'Data imported and stored in the database successfully.');
    }

    private function extractItemName($itemName, $brand, $model, $size)
    {

        $itemName = str_replace([$brand, $model, $size], '', $itemName);
        return trim($itemName);
    }
}
