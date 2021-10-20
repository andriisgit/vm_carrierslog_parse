<?php
class Parse
{
	private $fileName, $fileIterator, $export;
	
	public function __construct(string $fileName = '')
	{
		$this->fileName = $fileName;
		$this->fileIterator = new FileIterator($fileName);
		$this->export = new OneSheet\Writer();
	}


	public function run()
	{
		$this->export->disableCellAutosizing();
		$this->export->addRow(['Date', 'Customer', 'Sum'], (new OneSheet\Style\Style())->setFontBold());
		
		foreach ($this->parse() as $line) {
			$this->export->addRow(array_values($line));
		}
		
		$this->export->writeToFile($this->fileName . '.xlsx');
	}
	
	
	public function parse()
	{
		foreach($this->fileIterator as $line) {
			
			$posTotal = strpos($line, 'TOTAL - ');
			$posCstmr = strpos($line, 'customer - ');
			
			$date = explode('|', $line)[0];
			$cstmr = trim(substr($line, $posCstmr + strlen('customer - ')));
			$total = trim(substr($line, $posTotal + strlen('TOTAL - '), $posCstmr - $posTotal - strlen('TOTAL - ')));
			
			yield ['date' => $date, 'cstmr' => $cstmr, 'total' => $total];

		}
	}
}