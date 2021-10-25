<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

use App\Models\User;

class XMLController extends Controller
{
    public function prueba_nueva_xml() {
        $users = User::all();
        return response()->view('contabilidad.adeudosXML', [
            'usuarios' => $users
        ])->header('Content-Type', 'text/xml');
    }

    public function prueba_xml(){
        $data_array = array(
            array(
                'title' => 'title1',
                'content' => 'content1',
                'pubdate' => '2009-10-11',
            ),
            array(
                'title' => 'title2',
                'content' => 'content2',
                'pubdate' => '2009-11-11',
            )
        );
        $title_size = 1;
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<article>\n";
        foreach ($data_array as $data) {
            $xml .= $this->create_item($data['title'], $title_size, $data['content'], $data['pubdate']);
        }
        $xml .= "</article>\n";

        return response($xml ,200)->header("Content-type","text/xml");

    }

 /**
     * Shenma busca datos estructurados, el contenido específico del nodo escrito: yangxingyi
  */
    private function create_item($title_data, $title_size, $content_data, $pubdate_data)
    {
        $item = "<item>\n";
        $item .= "<title size=\"" . $title_size . "\">" . $title_data . "</title>\n";
        $item .= "<content>" . $content_data . "</content>\n";
        $item .= " <pubdate>" . $pubdate_data . "</pubdate>\n";
        $item .= "</item>\n";
        return $item;
    }

    public function saveXML()
    {

        $xml_datos = array(
            array(
                'title' => 'title1',
                'content' => 'content1',
                'pubdate' => '2009-10-11',
            ),
            array(
                'title' => 'title2',
                'content' => 'content2',
                'pubdate' => '2009-11-11',
            )
        );

        $output = View::make('contabilidad.adeudosXML')->with(compact('xml_datos'))->render();

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?> \n <Document xmlns=\"urn:iso:std:iso:20022:tech:xsd:pain.008.001.02\">" .$output;

        $response = Response::create($xml, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . yourFileNameHere . '');
        $response->header('Content-Transfer-Encoding', 'binary');
        return $response;
    }

    public function GuardarXML(){

        // $xml = new \DomDocument('1.0', 'UTF-8'); //Se crea el docuemnto
        // $raiz = $xml->createElement('raiz');
        // $raiz = $xml->appendChild($raiz);

        // $nodo_First = $xml->createElement('Grafico');
        // $nodo_First = $raiz->appendChild($nodo_First);

        // /*---------------------------------------------inicio nodo_Second nodo de vector---------------------------------*/

        // $nodo_Second = $xml->createElement('options');
        // $nodo_Second = $nodo_First->appendChild($nodo_Second);

        // /*---------------------------------------------Inicio nodo_Third nodo de atributo--------------------------------*/

        // $nodo_Third = $xml->createElement('chart');
        // $nodo_Third = $nodo_Second->appendChild($nodo_Third);

        // $subnodo = $xml->createElement('type', $xml_datos[$i]->{'options'}->{'chart'}->{'type'}.'');
        // $subnodo = $nodo_Third->appendChild($subnodo);

        // //Se eliminan espacios en blanco
        // $xml->preserveWhiteSpace = false;

        // //Se ingresa formato de salida
        // $xml->formatOutput = true;

        // //Se instancia el objeto
        // $xml_string =$xml->saveXML();

        $data_array = array(
            array(
                'title' => 'title1',
                'content' => 'content1',
                'pubdate' => '2009-10-11',
            ),
            array(
                'title' => 'title2',
                'content' => 'content2',
                'pubdate' => '2009-11-11',
            )
        );
        $title_size = 1;
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<article>\n";
        foreach ($data_array as $data) {
            $xml .= $this->create_item($data['title'], $title_size, $data['content'], $data['pubdate']);
        }
        $xml .= "</article>\n";

        $nombre_archivo = time().'nombre_archivo.xml';
        
        //Y se guarda en el nombre del archivo 'achivo.xml', y el obejto nstanciado
        Storage::disk('public')->put($nombre_archivo, $xml);

        $pathToFile = storage_path("app/public/" . $nombre_archivo);

        return response()->download($pathToFile);

    }

}
