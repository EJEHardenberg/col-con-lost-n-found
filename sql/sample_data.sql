INSERT INTO events (name, enabled) VALUES ('Sample Event', true);
SET @event_id = LAST_INSERT_ID();

INSERT INTO featuretypes (event_id,name,is_multi,is_dropdown) VALUES (@event_id, 'Color',true,false);
SET @colortype_id = LAST_INSERT_ID();

INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'red');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'yellow');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'blue');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'green');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'black');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @colortype_id, 'white');

INSERT INTO featuretypes (event_id, name, is_multi, is_dropdown) VALUES (@event_id, 'Lost in',false,true);
SET @lostin_id = LAST_INSERT_ID();

INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @lostin_id, 'The living room');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @lostin_id, 'The dining room');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @lostin_id, 'The parlor room');

INSERT INTO featuretypes (event_id, name, is_multi, is_dropdown) VALUES (@event_id, 'Lost on', false, true);
SET @loston_id = LAST_INSERT_ID();

INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Sunday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Monday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Tuesday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Wednesday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Thursday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Friday');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @loston_id, 'Saturday');

INSERT INTO featuretypes (event_id, name, is_multi, is_dropdown) VALUES (@event_id, 'Item Type', false, true);
SET @itemtype_id = LAST_INSERT_ID();

INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @itemtype_id, 'Candlestick');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @itemtype_id, 'Plate');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @itemtype_id, 'Bowl');
INSERT INTO features (event_id,feature_type,name) VALUES (@event_id, @itemtype_id, 'Silverware');