create table mobilepayments (
    transLoID int AUTO_INCREMENT PRIMARY KEY not null,
    Transactiontype varchar(10) not null,
    TransID varchar(10) UNIQUE not null,
    TransTime varchar(14) not null,
    TransAmount varchar(6) not null,
    BusinessShortCode varchar(6) not null,
    BillRefNumber varchar(6) not null,
    InvoiceNumber varchar(6) not null,
    OrgAccountBalance varchar(10) not null,
    ThirdPartyTransID varchar(10) not null,
    MSISDN varchar(14) not null,
    FirstName varchar(10),
    MiddleName varchar(10),
    LastName varchar(10)
);