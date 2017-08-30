<?php
declare(strict_types=1);

/**
 * @codingStandardsIgnoreFile
 */

namespace Tests\Mock;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class MockPlatform
 * @package Tests\Mock
 */
class MockPlatform extends AbstractPlatform
{
    /**
     * Gets the SQL Snippet used to declare a BLOB column type.
     *
     * @param array $field
     *
     * @return string|void
     * @throws DBALException
     */
    public function getBlobTypeDeclarationSQL(array $field)
    {
        throw DBALException::notSupported(__METHOD__);
    }

    /**
     * Returns the SQL snippet that declares a boolean column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getBooleanTypeDeclarationSQL(array $columnDef): ?string
    {
        return null;
    }

    /**
     * Returns the SQL snippet that declares a 4 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getIntegerTypeDeclarationSQL(array $columnDef): ?string
    {
        return null;
    }

    /**
     * Returns the SQL snippet that declares an 8 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getBigIntTypeDeclarationSQL(array $columnDef): ?string
    {
        return null;
    }

    /**
     * Returns the SQL snippet that declares a 2 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getSmallIntTypeDeclarationSQL(array $columnDef): ?string
    {
        return null;
    }

    /**
     * Returns the SQL snippet that declares common properties of an integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function _getCommonIntegerTypeDeclarationSQL(array $columnDef): ?string
    {
        return null;
    }

    /**
     * Returns the SQL snippet used to declare a VARCHAR column type.
     *
     * @param array $field
     *
     * @return string
     */
    public function getVarcharTypeDeclarationSQL(array $field): string
    {
        return 'DUMMYVARCHAR()';
    }

    /**
     * @param array $field
     *
     * @return string
     */
    public function getClobTypeDeclarationSQL(array $field): string
    {
        return 'DUMMYCLOB';
    }

    /**
     * @param array $field
     *
     * @return string
     */
    public function getJsonTypeDeclarationSQL(array $field): string
    {
        return 'DUMMYJSON';
    }

    /**
     * @param array $field
     *
     * @return string
     */
    public function getBinaryTypeDeclarationSQL(array $field): string
    {
        return 'DUMMYBINARY';
    }

    /**
     * Gets the name of the platform.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'mock';
    }

    protected function initializeDoctrineTypeMappings(): void
    {
    }

    /**
     * @param integer $length
     * @param boolean $fixed
     *
     * @return string
     *
     * @throws DBALException If not supported on this platform.
     */
    protected function getVarcharTypeDeclarationSQLSnippet($length, $fixed): ?string
    {
        return null;
    }
}
