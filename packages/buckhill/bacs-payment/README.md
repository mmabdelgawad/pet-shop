# Bacs Payment
 
This package is responsible for generating valid BACS payment responses. Generated responses will be using BACS Standard 18 format. 

* Only `vol` and `hdr1` records are implemented.
* This package exposes one endpoint only `[POST] api/bacs`. 
* When calling this endpoint you need pass these parameters
  * `vol.owner_id` 
  * `vol.owner_id_no` 
  * `hdr1.file_creation_date` 
  * `hdr1.file_expiration_date` 


> * For `unit` and `feature` tests please go to `tests` directory.
> 
> * For api documentation please see `api-docs.json`.