<?php

namespace Buckhill\BacsPayment\Bacs\Records;

use Buckhill\BacsPayment\Bacs\MessageRecord;
use Illuminate\Support\Str;

class VolRecord extends MessageRecord
{
    private array $validatedData;

    public function __construct(array $validatedData)
    {
        $this->validatedData = $validatedData;

        $this->setLabelIdentifier();
        $this->setLabelNumber();
        $this->setSerialNumber();
        $this->setAccessibilityIndicator();
        $this->setReservedField1();
        $this->setReservedField2();
        $this->setOwnerId();
        $this->setReservedField();
        $this->setLabelStandardLevel();
    }

    private string $labelIdentifier;

    private string $labelNumber;

    private string $serialNumber;

    private string $accessibilityIndicator;

    private string $reservedField1;

    private string $reservedField2;

    private string $ownerId;

    private string $reservedField;

    private string $labelStandardLevel;

    public function getLabelIdentifier(): string
    {
        return $this->labelIdentifier;
    }

    public function getLabelNumber(): string
    {
        return $this->labelNumber;
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    public function getAccessibilityIndicator(): string
    {
        return $this->accessibilityIndicator;
    }

    public function getReservedField1(): string
    {
        return $this->reservedField1;
    }

    public function getReservedField2(): string
    {
        return $this->reservedField2;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getReservedField(): string
    {
        return $this->reservedField;
    }

    public function getLabelStandardLevel(): string
    {
        return $this->labelStandardLevel;
    }

    private function setLabelIdentifier(): void
    {
        $this->labelIdentifier = 'VOL';
    }

    private function setLabelNumber(): void
    {
        $this->labelNumber = '1';
    }

    private function setSerialNumber(): void
    {
        $this->serialNumber = Str::random(6);
    }

    private function setAccessibilityIndicator(): void
    {
        $this->accessibilityIndicator = '0';
    }

    private function setReservedField1(): void
    {
        $this->reservedField1 = str_repeat(' ', 20);
    }

    private function setReservedField2(): void
    {
        $this->reservedField2 = str_repeat(' ', 6);
    }

    private function setOwnerId(): void
    {
        $ownerId = $this->validatedData['vol']['owner_id'];

        if ($this->validatedData['vol']['owner_id'] === 'BACS') {
            $ownerIdNo = $this->validatedData['vol']['owner_id_no'];
        } else {
            $ownerIdNo = str_repeat(' ', 2);
        }

        $this->ownerId = str_repeat(' ', 4).$ownerId.$ownerIdNo.str_repeat(' ', 4);
    }

    private function setReservedField(): void
    {
        $this->reservedField = str_repeat(' ', 28);
    }

    private function setLabelStandardLevel(): void
    {
        $this->labelStandardLevel = '1';
    }

    public function buildRecord(): string
    {
        return sprintf(
            '%s%s%s%s%s%s%s%s%s',
            $this->getLabelIdentifier(),
            $this->getLabelNumber(),
            $this->getSerialNumber(),
            $this->getAccessibilityIndicator(),
            $this->getReservedField1(),
            $this->getReservedField2(),
            $this->getOwnerId(),
            $this->getReservedField(),
            $this->getLabelStandardLevel()
        );
    }
}
