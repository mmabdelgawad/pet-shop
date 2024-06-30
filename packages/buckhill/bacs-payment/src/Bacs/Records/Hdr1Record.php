<?php

namespace Buckhill\BacsPayment\Bacs\Records;

use Buckhill\BacsPayment\Bacs\MessageRecord;
use Carbon\Carbon;

class Hdr1Record extends MessageRecord
{
    private array $validatedData;

    private string $volRecord;

    public function __construct(array $validatedData, string $volRecord)
    {
        $this->validatedData = $validatedData;
        $this->volRecord = $volRecord;

        $this->setLabelIdentifier();
        $this->setLabelNumber();
        $this->setFileIdentifier();
        $this->setSetIdentifier();
        $this->setFileSectionNumber();
        $this->setFileSequenceNumber();
        $this->setGenerationNumber();
        $this->setGenerationVersionNumber();
        $this->setCreationDate();
        $this->setExpirationDate();
        $this->setAccessibilityIndicator();
        $this->setBlockCount();
        $this->setSystemCode();
        $this->setReservedField();
    }

    private string $labelIdentifier;

    private string $labelNumber;

    private string $fileIdentifier;

    private string $setIdentifier;

    private string $fileSectionNumber;

    private string $fileSequenceNumber;

    private string $generationNumber;

    private string $generationVersionNumber;

    private string $creationDate;

    private string $expirationDate;

    private string $accessibilityIndicator;

    private string $blockCount;

    private string $systemCode;

    private string $reservedField;

    public function getLabelIdentifier(): string
    {
        return $this->labelIdentifier;
    }

    public function getLabelNumber(): string
    {
        return $this->labelNumber;
    }

    public function getFileIdentifier(): string
    {
        return $this->fileIdentifier;
    }

    public function getSetIdentifier(): string
    {
        return $this->setIdentifier;
    }

    public function getFileSectionNumber(): string
    {
        return $this->fileSectionNumber;
    }

    public function getFileSequenceNumber(): string
    {
        return $this->fileSequenceNumber;
    }

    public function getGenerationNumber(): string
    {
        return $this->generationNumber;
    }

    public function getGenerationVersionNumber(): string
    {
        return $this->generationVersionNumber;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getAccessibilityIndicator(): string
    {
        return $this->accessibilityIndicator;
    }

    public function getBlockCount(): string
    {
        return $this->blockCount;
    }

    public function getSystemCode(): string
    {
        return $this->systemCode;
    }

    public function getReservedField(): string
    {
        return $this->reservedField;
    }

    private function setLabelIdentifier(): void
    {
        $this->labelIdentifier = 'HDR';
    }

    private function setLabelNumber(): void
    {
        $this->labelNumber = '1';
    }

    private function setFileIdentifier(): void
    {
        $ownerIdNo = $this->extractPart($this->volRecord, 42, 47);

        $this->fileIdentifier = 'A'.$ownerIdNo.'S'.str_repeat(' ', 3).$ownerIdNo;
    }

    private function setSetIdentifier(): void
    {
        $this->setIdentifier = $this->extractPart($this->volRecord, 5, 10);
    }

    private function setFileSectionNumber(): void
    {
        $this->fileSectionNumber = '0001';
    }

    private function setFileSequenceNumber(): void
    {
        $this->fileSequenceNumber = '0001';
    }

    private function setGenerationNumber(): void
    {
        $this->generationNumber = str_repeat(rand(0, 9), 4);
    }

    private function setGenerationVersionNumber(): void
    {
        $this->generationVersionNumber = str_repeat(rand(0, 9), 2);
    }

    private function setCreationDate(): void
    {
        $this->creationDate = ' '.Carbon::parse($this->validatedData['hdr1']['file_creation_date'])->isoFormat('YYDDDD');
    }

    private function setExpirationDate(): void
    {
        $this->expirationDate = ' '.Carbon::parse($this->validatedData['hdr1']['file_expiration_date'])->isoFormat('YYDDDD');
    }

    private function setAccessibilityIndicator(): void
    {
        $this->accessibilityIndicator = 0;
    }

    private function setBlockCount(): void
    {
        $this->blockCount = str_repeat('0', 6);
    }

    private function setSystemCode(): void
    {
        $this->systemCode = str_repeat(' ', 13);
    }

    private function setReservedField(): void
    {
        $this->reservedField = str_repeat(' ', 7);
    }

    public function buildRecord(): string
    {
        return sprintf(
            '%s%s%s%s%s%s%s%s%s%s%s%s%s%s',
            $this->getLabelIdentifier(),
            $this->getLabelNumber(),
            $this->getFileIdentifier(),
            $this->getSetIdentifier(),
            $this->getFileSectionNumber(),
            $this->getFileSequenceNumber(),
            $this->getGenerationNumber(),
            $this->getGenerationVersionNumber(),
            $this->getCreationDate(),
            $this->getExpirationDate(),
            $this->getAccessibilityIndicator(),
            $this->getBlockCount(),
            $this->getSystemCode(),
            $this->getReservedField(),
        );
    }
}
