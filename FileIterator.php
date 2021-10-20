<?php 
class FileIterator implements Iterator 
{
    protected $fileHandle;

    protected $line;
    protected $i;

    public function __construct(string $fileName) {
        if (!$this->fileHandle = fopen($fileName, 'r')) {
            throw new RuntimeException('File "' . $fileName . '" open error!');
        }
    }

    public function rewind() 
	{
        fseek($this->fileHandle, 0);
        $this->line = fgets($this->fileHandle);
        $this->i = 0;
    }

    public function valid() 
	{
        return false !== $this->line;
    }

    public function current() 
	{
        return $this->line;
    }

    public function key() 
	{
        return $this->i;
    }

    public function next() 
	{
        if (false !== $this->line) {
            $this->line = fgets($this->fileHandle);
            $this->i++;
        }
    }

    public function __destruct() 
	{
        fclose($this->fileHandle);
    }
}