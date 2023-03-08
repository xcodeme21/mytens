<?php

    $options = getopt("t:o:h");

    if (isset($options['h'])) {
        echo "Usage: php mytools.php <input_file> [-t <output_type>] [-o <output_file_path>] [-h]\n";
        echo "-t: Output type. Valid options are 'text' and 'json'. Default is 'text'.\n";
        echo "-o: Output file path.\n";
        echo "-h: Show usage information.\n";
        exit(0);
    }

    if (!isset($argv[1])) {
        echo "Input file path is required\n";
        exit(1);
    }

    $inputFilePath = $argv[1];
    $outputType = isset($options['t']) ? $options['t'] : 'text';
    $outputPath = isset($options['o']) ? $options['o'] : null;

    $fileContents = file_get_contents($inputFilePath);
    if ($fileContents === false) {
        echo "Failed to read input file\n";
        exit(1);
    }

    if ($outputType === 'json') {
        $outputContents = json_encode($fileContents);
        if ($outputContents === false) {
            echo "Failed to convert file to JSON\n";
            exit(1);
        }
    } else {
        $outputContents = $fileContents;
    }

    if ($outputPath !== null) {
        $result = file_put_contents($outputPath, $outputContents);
        if ($result === false) {
            echo "Failed to write output to file\n";
            exit(1);
        }
        echo "Output written to file: $outputPath\n";
    } else {
        echo $outputContents;
    }
    
?>