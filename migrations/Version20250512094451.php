<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512094451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEC54C8C93 FOREIGN KEY (type_id) REFERENCES property_type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE5E70BCD7 FOREIGN KEY (owned_by_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8BF21CDEC54C8C93 ON property (type_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8BF21CDEB03A8386 ON property (created_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8BF21CDE5E70BCD7 ON property (owned_by_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD phone_number VARCHAR(20) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP phone_number
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEC54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEB03A8386
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE5E70BCD7
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8BF21CDEC54C8C93 ON property
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8BF21CDEB03A8386 ON property
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8BF21CDE5E70BCD7 ON property
        SQL);
    }
}
