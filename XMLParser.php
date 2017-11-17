<?php
class monsterHunter
{
    public $rootNode;
    public $array = array();
    public $returnObject;
    function __construct($startNode)
    {
        $this->rootNode = $startNode;
    }
    function beginTheInquisition()
    {
        $this->theHunt($this->rootNode);
        //print count($this->array);
        return $this->array;
    }
    function theHunt($node)
    {
        foreach ($node as $child)
        {
            if (isset($child))
            {
                $this->theHunt($child);
            }
            //Now that I am all the way down or working my way back up. I start gathering my information.
            $this->returnObject = print_r($node,TRUE);
            array_push($this->array,$this->returnObject);
        }
    }
}

$xmlDoc = new DOMDocument();
$errorArray = array();
$print_rArray = array();
$dir = 'C:\Users\menth\Desktop\XML Files';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST );

libxml_use_internal_errors(true);

foreach ($iterator as $path)
{
    if (pathinfo($path,PATHINFO_EXTENSION) == 'xml')
    {
            try
            {
                $simplexml = new SimpleXMLElement($path, 0, TRUE);
                $test = new monsterHunter($simplexml);
                array_push($print_rArray,$test->beginTheInquisition());
            }
            catch (Exception $e)
            {
                array_push($errorArray,$path);
            }
    }
}
print 'I opened ' . count($print_rArray) . ' files.<br>';
print 'Something went wrong when trying to access the following files.<br>';
foreach ($errorArray as $item)
{
    print $item . '<br>';
}
?>
