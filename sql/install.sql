select 'Beginning Installation';

select 'initializing events - start', now();
source events.sql;
select 'initializing events - done', now();

select 'initializing item - start', now();
source item.sql;
select 'initializing item - done', now();

select 'initializing feature_type - start', now();
source feature_type.sql;
select 'initializing feature_type - done', now();

select 'initializing features - start', now();
source features.sql;
select 'initializing features - done', now();

select 'initializing item feature join table - start', now();
source item_features.sql;
select 'initializing item feature join table - done', now();


select 'Installation complete';